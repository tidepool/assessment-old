package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.utils.getTimer;
	
	public class Main extends Sprite 
	{
		private var instructions:Label;
		private var background:Loader;
		public var holders:Array;
		private var pencils:Array;
		public var taken:Array;
		public var choices:Array;
		public var penHolderValues:Array;
		private var xmlString:String;
		public var changeString:String;
		private var xmlData:XML;
		private var nextButton:Loader;
		private var nextButtonOver:Loader;
		public var elapsedTime:Number;
		public var prefix:String;
		public var timeDiff:Number;
		private var ID:String;
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			if (ExternalInterface.available) 
			{
				ExternalInterface.addCallback("recieveID", setID);
				ExternalInterface.call("getID", " ");
				var preLoader:Preloader = new Preloader(this);
			}
			
			prefix = "";
			changeString = "";
			removeEventListener(Event.ADDED_TO_STAGE, init);
			addEventListener(Event.ENTER_FRAME, update);
		
			background = new Loader();
			background.load(new URLRequest(prefix + "assets/background.jpg"));
			addChild(background);
			
			//instructions = new Label(this, 100, 25, "Look at each pencil below and consider what drives and inspires you.\nDrag and drop the pencils into the cups to show your 1st, 2nd, 3rd and 4th choices.", 35, 1400);
			instructions = new Label(this, 100, 25, "Look at each pencil below and consider what drives and inspires you.\nDrag and drop the pencils into the cups to show your 1st, 2nd, 3rd and 4th choices.", 35, 1400);
			instructions.addToMain();
			
			choices = new Array(null, null, null, null);
			penHolderValues = new Array(0, 0, 0, 0);
			taken = new Array(false, false, false, false);
			holders = new Array();
			holders[0] = new PenHolder(this, 400, 450, 1);
			holders[1] = new PenHolder(this, 700, 400, 2);
			holders[2] = new PenHolder(this, 1000, 400, 3);
			holders[3] = new PenHolder(this, 1300, 450, 4);
			
			pencils = new Array();			
			pencils[0] = new Pencil(this, 250, 575,"My desire for approval & acknowledgement","acceptance",1);
			pencils[1] = new Pencil(this, 750, 575,"Having good relationships at home & work","interdepndence",2);
			pencils[2] = new Pencil(this, 1250, 575, "Gaining power & influencing others","leadership",3);
			
			pencils[3] = new Pencil(this, 300, 650,"My drive for physical activity & vitality","energy",4);
			pencils[4] = new Pencil(this, 800, 650,"My desire to bring order to my home & workplace","orderliness",5);
			pencils[5] = new Pencil(this, 1300, 650, "My desire for inner peace & tranquility","peacefulness",6);
			
			pencils[6] = new Pencil(this, 500, 725,"My desire to learn about myself & my world","curiosity",7);
			pencils[7] = new Pencil(this, 1125, 725,"Giving to others & contributing to the world","altruism",8);
			
			nextButton = new Loader();
			nextButtonOver = new Loader();
			nextButton.load(new URLRequest(prefix + "assets/nextButton.png"));
			nextButtonOver.load(new URLRequest(prefix + "assets/nextButton-Over.png"));
			nextButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonLoaderReady);
			nextButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonLoaderReady);
		//	nextButton.addEventListener(MouseEvent.CLICK, click);
			elapsedTime = getTimer();
		}
		
		public function onNextButtonLoaderReady(e:Event) :void
		{   
			var width:Number = nextButton.width;
			nextButton.x = 800 - nextButton.width / 2;
			nextButton.y = 750;			
			
			
			nextButtonOver.x = 800 - nextButton.width / 2;
			nextButtonOver.y = 750;
			
			
			nextButton.addEventListener(MouseEvent.CLICK, click);
			nextButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			nextButtonOver.addEventListener(MouseEvent.CLICK, click);
			nextButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		public function update(e:Event):void
		{
			for (var i:int = 0; i < holders.length; i++ )
			{
				holders[i].update();
			}
			for (i = 0; i < pencils.length; i++ )
			{
				pencils[i].update();
			}
			
			if (contains(nextButton))
			{
		//		setChildIndex(nextButton, numChildren - 1);
			}
			
			if (choices[0] != null && choices[1] != null && choices[2] != null && choices[3] != null)
			{
				if (!contains(nextButton))
				{
					addChild(nextButton);							
					addChild(nextButtonOver);
					setChildIndex(nextButtonOver, numChildren-1);
					setChildIndex(nextButton, numChildren-1);
				}
			}
			else
			{
				if (contains(nextButton))
				{
					removeChild(nextButton);
					removeChild(nextButtonOver);
				}
			}
		}
		
		public function click(e:Event):void
		{
			xmlString = "<motivation>";
			xmlString += "<penHolders>";
			xmlString += "<choice1>" + choices[0] + "</choice1>";
			xmlString += "<choice2>" + choices[1] + "</choice2>";
			xmlString += "<choice3>" + choices[2] + "</choice3>";
			xmlString += "<choice4>" + choices[3] + "</choice4>";			
			xmlString += "</penHolders>";	
			xmlString += "<changes>" + changeString + "</changes>";	
			xmlString += "</motivation>";
			
			xmlData = new XML(xmlString);
			trace(xmlData);
			trace(xmlString);
			postData();
		}
		
		
		
		public function over(e:Event):void
		{
			setChildIndex(nextButtonOver, numChildren-1);
		}
		public function out(e:Event):void
		{
			setChildIndex(nextButton, numChildren-1);
		}
		
		public function setID(id:String):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostPenHolders.php");				
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			ID = "test-655d1f5";
			phpVariables.ID = ID;	
			xmlURLReq.data = phpVariables;
			xmlURLReq.method = URLRequestMethod.POST; 
			var xmlSendLoad:URLLoader = new URLLoader(); 
			xmlSendLoad.addEventListener(Event.COMPLETE, onComplete, false, 0, true); 
			xmlSendLoad.addEventListener(IOErrorEvent.IO_ERROR, onIOError, false, 0, true); 
			xmlSendLoad.load(xmlURLReq); 
		}
		
		private function onComplete(evt:Event):void 
		{     
			try 
			{         
				//xmlResponse = new XML(evt.target.data);  
				var temp:String = evt.target.data;
				trace(temp);         
				if (temp == "complete")
				{
					makeCall();
				}
				removeEventListener(Event.COMPLETE, onComplete);         
				removeEventListener(IOErrorEvent.IO_ERROR, onIOError);     
			} 
			catch (err:TypeError) 
			{         
				trace("An error occured when communicating with server:\n" + err.message);     
			}     
		} 
		
		private function onIOError(evt:IOErrorEvent):void 
		{     
			trace("An error occurred when attempting to load the XML.\n" + evt.text);  
		} 
		
		public function makeCall():void
		{
			if (ExternalInterface.available) {
				graphics.clear();
				while (numChildren > 0)
				{
					removeChildAt(0);		
				}
                ExternalInterface.call("sendToJavaScript", xmlString);
            }
			else
			{				
				graphics.clear();
				while (numChildren > 0)
				{
					removeChildAt(0);		
				}
			}
		}
	}
}
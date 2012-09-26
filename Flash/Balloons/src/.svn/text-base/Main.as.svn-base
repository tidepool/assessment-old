package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.events.*;
	import flash.net.*;
	import flash.external.*;
	import flash.utils.getTimer;
	
	public class Main extends Sprite
	{
		public var balloons:Array = new Array();
		public var xmlString:String;
		public var prefix:String;
		
		private var nextButton:Loader;
		private var nextButtonOver:Loader;
		private var background:Loader;
		private var ID:String;
		
		public var elapsedTime:Number;
		public var timeDiff:Number;
		public var changeString:String;
		
		public function Main():void
		{
			if (stage)
				init();
			else
				addEventListener(Event.ADDED_TO_STAGE, init);
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
			background = new Loader();
			background.load(new URLRequest(prefix + "assets/background.jpg"));
			addChild(background);
			
			xmlString = "<balloon>";
			addEventListener(Event.ENTER_FRAME, update);
			
			new Label(this, 800, 50, "Please drag the balloons below to preference your incentives.", 35, 1200);
			
			var offset:int = -4;
			balloons.push(new Balloon(this, 94 + offset, 400, 1, "Benefits"));
			balloons.push(new Balloon(this, 271 + offset, 400, 2, "Training"));
			balloons.push(new Balloon(this, 448 + offset, 400, 3, "Money"));
			balloons.push(new Balloon(this, 625 + offset, 400, 4, "Support"));
			balloons.push(new Balloon(this, 802 + offset, 400, 5, "Appreciation"));
			balloons.push(new Balloon(this, 979 + offset, 400, 6, "Advancement"));
			balloons.push(new Balloon(this, 1156 + offset, 400, 7, "Credit"));
			balloons.push(new Balloon(this, 1333 + offset, 400, 8, "Education"));
			balloons.push(new Balloon(this, 1510 + offset, 400, 9, "Time Off"));
			
			nextButton = new Loader();
			nextButton.load(new URLRequest(prefix + "assets/nextButton.png"));
			nextButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonReady);
			nextButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			
			nextButtonOver = new Loader();
			nextButtonOver.load(new URLRequest(prefix + "assets/nextButtonOver.png"));
			nextButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonReady);
			nextButtonOver.addEventListener(MouseEvent.CLICK, onMouseClick);
			nextButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
			elapsedTime = getTimer();
			changeString = "";
		}
		
		private function onNextButtonReady(e:Event):void
		{
			
			addChild(nextButtonOver);
			nextButtonOver.x = 800 - nextButtonOver.width / 2;
			nextButtonOver.y = 750;
			
			nextButton.x = 800 - nextButton.width / 2;
			nextButton.y = 750;
			addChild(nextButton);
			setChildIndex(nextButton, numChildren - 1);
		}
		
		private function over(e:Event):void
		{
			if (contains(nextButtonOver))
			{
				setChildIndex(nextButtonOver, numChildren - 1);
			}
		}
		
		private function out(e:Event):void
		{
			if (contains(nextButton))
			{
				setChildIndex(nextButton, numChildren - 1);
			}
		}
		
		private function update(e:Event):void
		{
			for (var i:int = 0; i < balloons.length; i++)
			{
				balloons[i].update();
			}
			//trace(balloons[0].value);
		}
		
		private function onMouseClick(e:Event):void
		{
			xmlString += "<Benefits>" + Math.round(balloons[0].value) + "</Benefits>";
			xmlString += "<Training>" + Math.round(balloons[1].value) + "</Training>";
			xmlString += "<Money>" + Math.round(balloons[2].value) + "</Money>";
			xmlString += "<Support>" + Math.round(balloons[3].value) + "</Support>";
			xmlString += "<Appreciation>" + Math.round(balloons[4].value) + "</Appreciation>";
			xmlString += "<Advancement>" + Math.round(balloons[5].value) + "</Advancement>";
			xmlString += "<Credit>" + Math.round(balloons[6].value) + "</Credit>";
			xmlString += "<Education>" + Math.round(balloons[7].value) + "</Education>";
			xmlString += "<Time>" + Math.round(balloons[8].value) + "</Time>";
			xmlString += "<changes>" + changeString + "</changes>";
			xmlString += "</balloon>";
			
			var xmlData:XML = new XML(xmlString);
			trace(xmlData);
			postData();
		}
		
		private function setID(id):void
		{
			ID = id;
		}
		
		private function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostBalloon.php");
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "lhaqeaebf54ihj09";
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
		
		private function makeCall():void
		{
			if (ExternalInterface.available)
			{
				ExternalInterface.call("sendToJavaScript", xmlString);
			}
			else
			{
				while (numChildren > 0)
				{
					removeChildAt(0);
				}
			}
		}
	}
}
package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.text.TextField;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.utils.getTimer;	  
	import flash.utils.Timer;
	
	public class Main extends Sprite 
	{
		public var response:Array = new Array();
		public var replyMessage:ReplyMessage;
		public var responseGiven:Boolean;
		public var timer:int = 40;
		public var countTimer:Boolean = false;
		public var xmlString:String;
		public var prefix:String;
		
		private var changes:String;
		private var changeTime:Number;
		private var ID:String;
		private var techMessage:TechMessage;
		private var elapsedTime:Number;
		private var sendMessage:Loader;
		private var instructions:label;
		private var backgroundPhone:Loader;
		private var button1:ResponseButton;
		private var button2:ResponseButton;
		private var button3:ResponseButton;
		private var button4:ResponseButton;
		
		public function Main():void 
		{
			trace("start");
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
			run();
		}
		
		public function run():void
		{
			prefix = "";
			responseGiven = false;
			addEventListener(Event.ENTER_FRAME, update);		
			
			
			backgroundPhone = new Loader();
			backgroundPhone.load(new URLRequest(prefix + "assets/phoneBackground.png"));
			backgroundPhone.y = 100;
			addChild(backgroundPhone);
			setChildIndex(backgroundPhone, 0);
			
			button1 = new ResponseButton(this,397,651,"(no response)",1);			
			
			button2 = new ResponseButton(this, 595, 651,"Okay, well, it was nice to sort of know you!",2);
			
			button3 = new ResponseButton(this, 793, 651, "That’s fine, I haven’t actually needed your help anyway.",3);
			
			button4 = new ResponseButton(this,992,651,"Nooo! I need some help! Come back!",4);
			
			techMessage = new TechMessage(this,0,200,"I need to step away for a little while, I might not be around for the rest of your test");
			instructions = new label(this, 590, 595, 15, "Please Select Your Response Below");
		
			stage.addEventListener(KeyboardEvent.KEY_DOWN, displayKey);
			changeTime = getTimer();
			changes = "";
		}		
		
		function displayKey(keyEvent:KeyboardEvent):void
		{			
			if (keyEvent.keyCode == 84)
			{
				var temp:Number = getTimer() - changeTime;
				changeTime = getTimer();
				changes += "@" + temp;
				trace(changes);
			}		
		}
		
		public function update(e:Event):void
		{
			techMessage.update();
			if (replyMessage != null)
			{
				replyMessage.update();
			}
			if (timer < 0)
			{
			//	newMessage1();
				timer = 10;
				countTimer = false;
			}
			if (countTimer)
			{
				timer--;
			}
			
			if (getTimer() - elapsedTime > 5000)
			{			
				elapsedTime = 9999999;
				postData();
			}
		}
		public function newMessage():void
		{
			instructions.text.text = "";
			techMessage.positionY -= 130;
			countTimer = true;
			elapsedTime = getTimer();
		}
		
		public function newMessage1():void
		{
			
			new TechMessage1(this,0,240,"I’ll check back in a few minutes. If you need something, press “T” and I’ll get to you as soon as I can.    ");
			instructions.text.text = "";
			techMessage.positionY -= 95;
			replyMessage.positionY -= 105;
			elapsedTime = getTimer();
		}
		
		public function setID(id):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostIM4.php");				
			var phpVariables:URLVariables = new URLVariables();
			trace(changes);
			phpVariables.data = xmlString;
			phpVariables.changes = changes;
			phpVariables.ID = ID;	
			xmlURLReq.data = phpVariables;
			xmlURLReq.method = URLRequestMethod.POST; 
			var xmlSendLoad:URLLoader = new URLLoader(); 
			xmlSendLoad.addEventListener(Event.COMPLETE, onComplete, false, 0, true); 
			xmlSendLoad.addEventListener(IOErrorEvent.IO_ERROR, onIOError, false, 0, true); 
			xmlSendLoad.load(xmlURLReq); 
		}
		
		function onComplete(evt:Event):void 
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
		
		function onIOError(evt:IOErrorEvent):void 
		{     
			trace("An error occurred when attempting to load the XML.\n" + evt.text);  
		} 
		
		public function makeCall():void
		{
			trace (xmlString);
			var xmlData = new XML(xmlString);
			trace(xmlData);
			
			if (ExternalInterface.available) {
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
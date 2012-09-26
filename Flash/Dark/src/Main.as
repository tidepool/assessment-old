package 
{
	import flash.display.Sprite;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class Main extends Sprite 
	{
		public var screens:Array = new Array();
		public var index:int;
		public var strings:Array = new Array();
		public var stringsSort:Array = new Array();
		public var stringsSelected:Array = new Array();
		public var xmlString:String;
		public var prefix:String;		
		public var elapsedTime:Number;
		public var timeDiff:Number;
		public var changeString:String;
		public var textHint:Label;
		public var shouldFadeIn :Boolean= false;		
		public var taskTime:Number;
		
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
			// entry point

			run();
		}
		
		
		public function run():void
		{
			
			textHint = new Label(this,0,0,"");
			textHint.changeText(400, 500,45, "(Click to continue)");
			textHint.sprite.alpha = 0;
			addEventListener(Event.ENTER_FRAME, update);
			stage.addEventListener(KeyboardEvent.KEY_DOWN,keyPress);
			stage.addEventListener(MouseEvent.CLICK, keyPress);
			
			graphics.beginFill(0, 1);
			graphics.drawCircle(500, 500, 2000);
			graphics.endFill();
			
			index = 0;
			
			screens.push(new IntroScreen(this));
			
			screens.push(new PromptScreen(this,"Moon"));			
			screens.push(new PromptScreen(this,"Sun"));			
			screens.push(new PromptScreen(this,"Flower"));			
			screens.push(new PromptScreen(this,"Castle"));			
			screens.push(new PromptScreen(this,"Face"));
			
			screens.push(new PrimingScreen(this));
			screens.push(new ContinueScreen(this));
			
			screens.push(new FeedBackScreen(this, 0, "Low Creativity", "Moderate Creativity", "Highly Creative"));
			screens.push(new FeedBackScreen(this, 1, "Low Assertiveness", "Moderate Assertiveness", "Highly Assertive"));
			screens.push(new FeedBackScreen(this, 2, "Negative Mood", "Numb", "Positive Mood"));
			screens.push(new FeedBackScreen(this, 3, "A Thinker", "A Doer", "A Feeler"));
			screens.push(new FeedBackScreen(this, 4, "Emotionally Expressive", "Unaware of Emotion", "Emotionally Reserved"));
			
			
			screens.push(new FilmScreen(this));
			screens.push(new GenreScreen(this));
			
			screens.push(new SliderScreen(this, 0));
			screens.push(new SliderScreen(this, 1));
			screens.push(new SliderScreen(this, 2));
			screens.push(new SliderScreen(this, 3));
			screens.push(new SliderScreen(this,4));
			
			xmlString = "<dark>";
			
			screens[index].render();
			changeString = "<changes>";
		}
		
		public function update(e:Event):void
		{
			if (index < screens.length)
			{
				screens[index].update();
			}
			if (shouldFadeIn)
			{
				if(textHint.sprite.alpha<1)
					textHint.sprite.alpha += 0.05;
			}
		}
		
		public function keyPress(e:Event=null):void
		{
			if (index < screens.length)
			{
				screens[index].keyPress();
			}
		}
		
		public function displayNext():void
		{
			textHint.sprite.alpha = 0;
			shouldFadeIn = false;
			if (index < screens.length)
			{
				screens[index].writeXML();
				trace(xmlString);
			}
			index++;
			if (index >= screens.length)
			{
				
				xmlString += "</sliders>";				
				changeString += "</changes>";
				xmlString += changeString;
				xmlString += "</dark>";
				var xmlData:XML = new XML(xmlString);
				trace(xmlData);
				trace(xmlString);
				postData();
			}
			else
			{
				screens[index].render();
			}
			//trace(changeString);
		}
		
		public function setID(id):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostDark.php");				
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "95ojoo9909";
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
			trace("call made");
			if (ExternalInterface.available) {
                ExternalInterface.call("sendToJavaScript", xmlString);
            }
			else
			{				
				if (parent.parent != null )
				{
					parent.parent.removeChild(parent);
				}
			}
		}
	}
	
}
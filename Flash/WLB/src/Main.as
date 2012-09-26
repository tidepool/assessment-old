package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;	
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	
	public class Main extends Sprite 
	{
		public var screens:Array = new Array();
		public var index:int;
		public var strings:Array = new Array();
		public var stringsSort:Array = new Array();
		public var stringsSelected:Array = new Array();
		public var nextButton:Loader;
		public var nextButtonOver:Loader;
		public var xmlString:String;
		public var prefix:String;
		public var changesString:String;
		public var taskTime:Number;
		
		private var timeDiff:Number;		
		private var ID:int;

		
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
		
			
			run();
		}
		
		public function getTime():Number
		{
			timeDiff = getTimer() - taskTime;
			taskTime = getTimer();
			return timeDiff;
		}
		
		public function run():void
		{
			addEventListener(Event.ENTER_FRAME, update);
			stage.addEventListener(KeyboardEvent.KEY_DOWN,keyPress);
			xmlString = "<WLB>";
			
			index = 0;
			
			screens.push(new PieChartScreen(this));
			screens.push(new WorkLifeSlider1(this));
			screens.push(new Shiva(this));
			
			screens.push(new Map(this));
			
			
			screens.push(new Travel(this));
			
			screens.push(new Family(this));
			
			screens.push(new WorkLifeSlider2(this));
			
			screens.push(new Couch(this));			
			
			screens.push(new Net(this, "BigHeart.png","Providing service to others"));
			screens.push(new Net(this, "A+.png","Doing quality work"));
			screens.push(new Net(this, "PeopleComputer.jpg","Meeting expectations"));
			screens.push(new Net(this, "Girls.jpg","Getting along with peers"));
			screens.push(new Net(this, "Graph.jpg","Earning my paycheck"));
			
			screens.push(new Briefcase(this, 1, "Management understands my strengths and needs", "Not at all", "Somewhat", "Yes"));
			screens.push(new Briefcase(this, 2, "Peers care for me", "Not at all", "Somewhat", "Yes"));
			screens.push(new Briefcase(this, 3, "Productivity is rewarded in a meaningful way", "Not at all", "Sometimes", "Yes"));
			screens.push(new Briefcase(this, 4, "Creativity is rewarded in a meaningful way", "Not at all", "Occasionally", "Yes"));
			screens.push(new Briefcase(this, 5, "I am teamed with people who challenge and energize me", "Not at all", "Sometimes", "Yes"));
			screens.push(new Briefcase(this, 6, "My values and the companys values are well suited", "They are conflicted", "They do, but I'm fine with it", "We share the same values"));
			screens.push(new Briefcase(this, 7, "There are lots of people at work who share my values", "Not at all", "Somewhat", "Yes"));
			screens.push(new Briefcase(this, 8, "I enjoy spending time outside of the office with fellow employees", "No", "Sometimes", "Yes"));
			screens.push(new Briefcase(this, 9, "I am motivated to come to work each day", "No", "Sometimes", "Yes"));
			screens.push(new Briefcase(this, 10, "My work feels like a rewarding part of my life", "Not at all", "Somewhat", "Yes"));
			
			screens.push(new Office(this));
			
			screens.push(new Dream(this));			
			
			screens.push(new Trash(this));			
			
			screens.push(new Clock(this));
			
			screens.push(new CheckList(this));
			
			screens[index].render();
			
			nextButton = new Loader();
			nextButton.load(new URLRequest(prefix + "assets/nextButton.png"));
			nextButton.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonLoaderReady);
			nextButton.addEventListener(MouseEvent.CLICK, click);
			
			nextButtonOver = new Loader();
			nextButtonOver.load(new URLRequest(prefix + "assets/nextButton-Over.png"));
			nextButtonOver.contentLoaderInfo.addEventListener(Event.COMPLETE, onNextButtonLoaderReady);
			nextButtonOver.addEventListener(MouseEvent.CLICK, click);
			
			nextButton.addEventListener(MouseEvent.MOUSE_OVER, over);
			nextButtonOver.addEventListener(MouseEvent.MOUSE_OUT, out);
			changesString = "<changes>";
		}
		
		public function onNextButtonLoaderReady(e:Event) :void
		{   
			var width:Number = nextButton.width;
			nextButton.x = 800 - nextButton.width / 2;
			nextButton.y = 760 - nextButton.height / 2;
			if (!contains(nextButton))
			{
				addChild(nextButton);			
			}
			nextButtonOver.x = 800 - nextButtonOver.width / 2;
			nextButtonOver.y = 760 - nextButtonOver.height / 2;
			if (!contains(nextButtonOver))
			{
				addChild(nextButtonOver);	
			}
			if (contains(nextButton))
			{
				setChildIndex(nextButton,numChildren-1);
			}
		}
		
		
		public function over(e:Event):void
		{
			if (contains(nextButtonOver))
			setChildIndex(nextButtonOver, numChildren-1);
		}
		public function out(e:Event):void
		{
			if (contains(nextButton))
			setChildIndex(nextButton, numChildren-1);
		}
		
		
		public function update(e:Event):void
		{
			
			if (index < screens.length)
			{
				screens[index].update();
			}
			if (contains(nextButton))
			{
			//	setChildIndex(nextButton,numChildren-1);
			}
			if (index >= screens.length)
			{
				graphics.clear();
				Mouse.show();
				while (numChildren > 0)
				{
					removeChildAt(0);
				}
			}
		}
		
		public function keyPress(e:KeyboardEvent):void
		{
			screens[index].keyPress();
		}
		
		public function displayNext():void
		{			
			index++;
			if (index == 13)
			{
				xmlString += "</nets>";
				xmlString += "<briefcase>";
				changesString += "</nets>";
				changesString += "<briefcase>";
			}
			if (index >= screens.length)
			{
				graphics.clear();
				Mouse.show();
				while (numChildren > 0)
				{
					removeChildAt(0);
				}
			}
			else
			{
				graphics.clear();
				while (numChildren > 0)
				{
					removeChildAt(0);
				}				
				screens[index].render();
				if (index < 8 || index > 25)
				{
					if(index !=5)
					{
						showNextButton();
					}
				}
			}
			trace(changesString);
		}
		public function click(e:Event):void
		{
			screens[index].writeXML();
			trace(xmlString);
			screens[index].displayNext();
			
		}
		
		public function showNextButton():void
		{
			if (!this.contains(nextButton))
			{
				this.addChild(nextButton);
			}
			if (!this.contains(nextButtonOver))
			{
				this.addChild(nextButtonOver);
			}
			setChildIndex(nextButton,numChildren-1);
		}
		
		public function hideNextButton():void
		{
			if (contains(nextButton))
			{
				removeChild(nextButton);
			}
			if (contains(nextButtonOver))
			{
				removeChild(nextButtonOver);
			}
		}
		
		public function setID(id):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://tidepool.co/assessment/prototype/Posts/PostWLB.php");				
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = 635109;
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
                ExternalInterface.call("sendToJavaScript", xmlString);
            }
		}
		
	}
	
}
package
{
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.utils.getTimer;
	import flash.utils.Timer;
	
	public class Main extends MovieClip
	{
		
		public var bar:MacBar = null;
		public var stageIndex:int = 0;
		public var prefix:String;
		public var index:int;
		public var elapsedTime:Number;
		public var chosenPics:Array;
		public var cycleList:Array;
		public var xmlString:String;
		
		private var pictureList:Array;
		private var xmlData:XML;
		private var instructions:Label;
		private var numberOfPictures:int;
		private var nextButton:NextButton;
		private var background:Loader;
		private var timerBar:TimerBar;
		private var ID:String;
		private var pictureA:PictureWithFade;
		private var pictureB:PictureWithFade;
		private var high:Label;
		private var low:Label;
		private var picStrings:Array;

		
		public function Main():void
		{
			
			init();
		}
		
		private function init(e:Event = null):void
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			//loadList = new Array();
			if (ExternalInterface.available)
			{
				ExternalInterface.addCallback("recieveID", setID);
				ExternalInterface.call("getID", " ");
				var preLoader:Preloader = new Preloader(this);
			}
			else
			{
				displayWarning();
			}
			prefix = "";
		}
		
		public function displayWarning():void
		{
			var label:Label = new Label(this, 400, 300, "Next, select the picture you like more. Be aware that you only have a limited time \n\n\n\n(Click anywhere to continue when you are ready)", 35, 800);
			//var l:label = new label(this, 400, 300, ID, 35, 900);
			stage.addEventListener(MouseEvent.CLICK, run);
			graphics.beginFill(0xEEEEEE)
			graphics.drawRect( -9999, -9999, 9999, 9999);
			graphics.endFill();
		}
		
		public function run(e:Event = null):void
		{
			graphics.clear();
			while (numChildren > 0)
			{
				removeChildAt(0);
			}
			stage.removeEventListener(MouseEvent.CLICK, run);
			
			addEventListener(Event.ENTER_FRAME, update);
			
			background = new Loader();
			background.load(new URLRequest(prefix + "assets/background.jpg"));
			addChild(background);
			setChildIndex(background, 0);
			
			pictureA = new PictureWithFade(this, 400, 450);
			addChild(pictureA.myLoader);
			
			pictureB = new PictureWithFade(this, 1200, 450);
			addChild(pictureB.myLoader);
			
			instructions = new Label(this, 100, 25, "Click on the picture that best resonates with you", 35,1400,1,0xFFFFFF);
			
			timerBar = new TimerBar(this, 800, 100);
			
			pictureList = new Array();
			cycleList = new Array();
			chosenPics = new Array();
			chosenPics.push(new Array()); //1-8	
			chosenPics.push(new Array()); //9-16	
			chosenPics.push(new Array()); //17-24	
			picStrings = new Array();
			
			numberOfPictures = 24;
			for (var i:int = 1; i <= 24; i++)
			{
				picStrings.push(i);
			}
			for (i = 1; i <= numberOfPictures; i++)
			{
				var numIndex:int = getFileNumber();
				pictureList.push(picStrings[numIndex]);
				picStrings.splice(numIndex, 1);
				cycleList.push(0);
			}
			xmlString = "<space>";
			xmlString += "<picturePreference>";
			elapsedTime = getTimer();
			displayNext(true);
		
		}
		
		public function getFileNumber():int
		{
			var i:int = Math.random() * picStrings.length;
			return i;
		}
		
		private function update(e:Event):void
		{
			
			if (stageIndex == 0)
			{
				pictureA.update();
				pictureB.update();
				timerBar.update();
				if (getTimer() - elapsedTime > 5000)
				{
					displayNext(false);
				}
			}
			if (bar != null)
			{
				bar.update();
			}
			
			if (high != null && low != null)
			{
				var currTime:int = getTimer();
				currTime = currTime % 500;
				var height:Number = (currTime - 250) * (currTime - 250);
				height /= 2250;
				
				if (contains(high.sprite))
				{
					high.sprite.y = 0 + height;
				}
				if (contains(low.sprite))
				{
					low.sprite.y = 0 + height;
				}
			}
		}
		
		public function displayNext(clicked:Boolean):void
		{
			if (stageIndex == 0)
			{
				elapsedTime = getTimer();
				if (!clicked)
				{
					pictureList.push(index);
					cycleList[index - 1]++;
				}
				if (pictureList.length < 1)
				{
					xmlString += "</picturePreference>";
					xmlString += "<bars>";
					stageIndex++;
					loadBar();
					nextButton = new NextButton(this, 800, 600);
				}
				else
				{
					index = pictureList.shift();
					var num:int = Math.random() * 2;
					if (num == 1)
					{
						pictureA.loadNew("assets/a" + index + ".jpg");
						pictureB.loadNew("assets/b" + index + ".jpg");
					}
					else
					{
						pictureA.loadNew("assets/b" + index + ".jpg");
						pictureB.loadNew("assets/a" + index + ".jpg");
					}
				}
			}
			else if (stageIndex == 1)
			{
				xmlString += bar.getXML();
				stageIndex++;
				bar.remove();
				chosenPics[1].sortOn("time", Array.NUMERIC);
				bar = new MacBar(this);
				for (var i:int = 0; i < 8; i++)
				{
					bar.addUnit(chosenPics[1][i].url);
				}
				bar.setIntial();
			}
			else if (stageIndex == 2)
			{
				xmlString += bar.getXML();
				stageIndex++;
				bar.remove();
				chosenPics[2].sortOn("time", Array.NUMERIC);
				bar = new MacBar(this);
				for (i = 0; i < 8; i++)
				{
					bar.addUnit(chosenPics[2][i].url);
				}
				bar.setIntial();
			}
			else if (stageIndex == 3)
			{
				nextButton.remove();
				xmlString += bar.getXML();
				xmlString += "</bars>";
				xmlString += "</space>";
				xmlData = new XML(xmlString);
				trace(xmlData);
				trace(xmlString);
				postData();
			}
		}
		
		public function loadBar():void
		{
			instructions.changeText(100, 25, "Drag and drop these pictures into order according to what best fits you",35,1400,1,0xFFFFFF);
			high = new Label(this, 1050, 550, "High", 40, 800);
			low = new Label(this, -300, 550, "Low", 40, 800);
			pictureA.clear();
			pictureB.clear();
			timerBar.clear();
			bar = new MacBar(this);
			chosenPics[0].sortOn("time", Array.NUMERIC);
			for (var i:int = 0; i < 8; i++)
			{
				bar.addUnit(chosenPics[0][i].url);
			}
			bar.setIntial();
		}
		
		public function setID(id:String):void
		{
			ID = id;
			displayWarning();
		}
		
		public function postData():void
		{
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostSpace.php");
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "test--8szadv65w1v81";
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
			if (ExternalInterface.available)
				ExternalInterface.call("sendToJavaScript", xmlString);
		
		}
	}

}
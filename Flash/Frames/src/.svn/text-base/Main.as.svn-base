package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.utils.getTimer;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	
	public class Main extends Sprite
	{
		public var pictureDrags:Array = new Array();
		public var instructions1:Label;
		public var instructions2:Label;
		public var text1:Label;
		public var text2:Label;
		public var text3:Label;
		public var text4:Label;
		public var place1:Boolean;
		public var place2:Boolean;
		public var place3:Boolean;
		public var place4:Boolean;
		public var index:int;
		public var button:Option;
		public var picButton1:PictureButton;
		public var picButton2:PictureButton;
		public var startTime:Number;
		public var favOrder:Array;
		public var disableClick:Boolean = false;
		public var trashAvailable:Boolean;
		public var prefix:String;
		public var elapsedTime:Number;
		public var coolDownTimer:Number;
		public var tickTimer:Number;
		public var taskTime:Number;
		public var timeDiff:Number;
		public var changeString:String;
		
		private var timerBar:TimerBar;
		private var ID:String;
		private var primeSprite:Sprite;
		private var tooSlow:int;
		private var frames:Loader;
		private var xmlString:String;
		private var xmlData:XML;
		private var trash:Loader;
		private var background:Loader;
		private var nextButton:Loader;
		private var changeTime:Number = 0;
		private var countdown:int = 5;
		private var isWarning:Boolean = false;
		private var oldOrder:Array = new Array();
		private var primeTimer:Number;
		private var isPriming:Boolean = false;
		
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
			prefix = "http://s3.amazonaws.com/tidepool_flash/frames/";
			
			run();
		}
		
		public function run():void
		{
			
			addEventListener(Event.ENTER_FRAME, update);
			
			instructions1 = new Label(this, 50, 50, "Pick your favorite pictures and order them in rank by dragging them into the corresponding frame", 26, 500, 1, 0x333333);
			instructions2 = new Label(this, 1100, 25, "");
			text1 = new Label(this, 695, 115, "1", 60, 190);
			text1.addBold();
			text2 = new Label(this, 440, 365, "2", 55, 200);
			text2.addBold();
			text3 = new Label(this, 700, 360, "3", 55, 200);
			text3.addBold();
			text4 = new Label(this, 950, 355, "4", 55, 200);
			text4.addBold();
			
			pictureDrags.push(new PictureDrag(this, 200, 600, "assets/F1a.jpg"));
			pictureDrags.push(new PictureDrag(this, 450, 600, "assets/F1b.jpg"));
			pictureDrags.push(new PictureDrag(this, 700, 600, "assets/F1c.jpg"));
			pictureDrags.push(new PictureDrag(this, 950, 600, "assets/F1d.jpg"));
			pictureDrags.push(new PictureDrag(this, 1200, 600, "assets/F1e.jpg"));
			
			place1 = false;
			place2 = false;
			place3 = false;
			place4 = false;
			index = 0;
			
			background = new Loader();
			background.load(new URLRequest(prefix + "assets/background.jpg"));
			addChild(background);
			setChildIndex(background, 0);
			
			frames = new Loader();
			frames.load(new URLRequest(prefix + "assets/frames.png"));
			addChild(frames);
			setChildIndex(frames, 1);
			trash = new Loader();
			trash.load(new URLRequest(prefix + "assets/trashCan.png"));
			trashAvailable = false;
			
			favOrder = new Array(0, 0, 0, 0, 0);
			xmlString = "<frames>";
			xmlString += "<sets>";
			
			addEventListener(MouseEvent.CLICK, Click);
			elapsedTime = getTimer();
			taskTime = getTimer();
			changeString = "<changes><frames1><set1>";
			tooSlow = 0;
			
			primeSprite = new Sprite();
			addChild(primeSprite);
		}
		
		private function update(e:Event):void
		{
			if (isPriming)
			{
				if (getTimer() - primeTimer < 50)
				{
					return;
				}
				else
				{
					isPriming = false;
					primeSprite.graphics.clear();
				}
			}
			//trace(index);
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				pictureDrags[i].update();
			}
			
			if (index >= 7)
			{
				var temp:Number = getTimer();
				if (temp - coolDownTimer > 400)
				{
					disableClick = false;
				}
				
				timerBar.update();
				
				if (getTimer() - startTime > 5000)
				{
					tooSlow = 1;
					displayNext();
						//text1.changeText(500, 600, "Time for the last pictures has expired. Please select faster", 30, 600);
				}
			}
			if (index < 7)
			{
				if (place1 && place2 && place3 && place4)
				{
					addChild(trash);
					if (contains(trash))
					{
						setChildIndex(trash, 0);
						setChildIndex(trash, 2);
					}
					trashAvailable = true;
					if (!isWarning)
						instructions2.changeText(1050, 50, "To continue, drag the last picture to the trash can", 26, 400, 1, 0x333333);
				}
				else if (trashAvailable)
				{
					removeChild(trash);
					trashAvailable = false;
					instructions2.text.text = "";
				}
				
			}
			if (contains(instructions1.sprite))
			{
				setChildIndex(instructions1.sprite, numChildren - 1);
			}
			if (contains(instructions2.sprite))
			{
				setChildIndex(instructions2.sprite, numChildren - 1);
			}
		}
		
		public function displayWarning():void
		{
			trash.load(new URLRequest(prefix + "assets/promptBox.png"));
			text1.changeText(0, 0, "", 1);
			text2.changeText(0, 0, "", 1);
			text3.changeText(300, 350, "", 40);
			text4.changeText(0, 0, "", 1);
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				pictureDrags[i].remove();
			}
			instructions1.changeText(375, 245, "Next, select the picture you like more.\n Be aware that you only have a limited time", 26, 850,1,0x333333);
			instructions2.changeText(375, 350, "(Click anywhere to continue when you are ready)", 20, 850, 1, 0x888888);
			
			if (contains(frames))
			{
				removeChild(frames);
			}
			isWarning = true;
			stage.addEventListener(MouseEvent.CLICK, cont);
		}
		
		public function displayNext():void
		{
			trace("String XML:" + xmlString);
			trace("Next index:" + index);
			timeDiff = getTimer() - taskTime;
			taskTime = getTimer();
			if (index == 6)
			{
				if (!isWarning)
				{
					displayWarning();
					frames.load(new URLRequest(prefix + "assets/frames2.png"));
					frames.y = 50;
					return;
				}
				else
				{
					isWarning = false;
					removeChild(trash);
					addChild(frames);
					instructions1.text.width = 600;
					tickTimer = getTimer();
					coolDownTimer = getTimer();
				}
			}
			
			index++;
			if (index < 7)
			{
				pictureDrags[0].changePicture("assets/F" + (index + 1) + "a.jpg");
				pictureDrags[1].changePicture("assets/F" + (index + 1) + "b.jpg");
				pictureDrags[2].changePicture("assets/F" + (index + 1) + "c.jpg");
				pictureDrags[3].changePicture("assets/F" + (index + 1) + "d.jpg");
				pictureDrags[4].changePicture("assets/F" + (index + 1) + "e.jpg");
				place1 = false;
				place2 = false;
				place3 = false;
				place4 = false;
				xmlString += "<set" + (index) + ">";
				xmlString += "<choice1>" + favOrder[0] + "</choice1>";
				xmlString += "<choice2>" + favOrder[1] + "</choice2>";
				xmlString += "<choice3>" + favOrder[2] + "</choice3>";
				xmlString += "<choice4>" + favOrder[3] + "</choice4>";
				xmlString += "<choice5>" + favOrder[4] + "</choice5>";
				xmlString += "</set" + (index) + ">";
				changeString += "*total@" + timeDiff;
				changeString += "</set" + (index) + "><set" + (index + 1) + ">";
			}
			if (index == 7)
			{
				clear();
				picButton1 = new PictureButton(this, 507, 335.5, "assets/P" + (index - 6) + "a.jpg");
				picButton2 = new PictureButton(this, 1091, 335.5, "assets/P" + (index - 6) + "b.jpg");
				xmlString += "<set" + (index) + ">";
				xmlString += "<choice1>" + favOrder[0] + "</choice1>";
				xmlString += "<choice2>" + favOrder[1] + "</choice2>";
				xmlString += "<choice3>" + favOrder[2] + "</choice3>";
				xmlString += "<choice4>" + favOrder[3] + "</choice4>";
				xmlString += "<choice5>" + favOrder[4] + "</choice5>";
				xmlString += "</set" + (index) + ">";
				xmlString += "</sets>";
				xmlString += "<pairs>";
				changeString += "*total@" + timeDiff;
				changeString += "</set" + (index) + "></frames1><frames2><set" + (index - 6) + ">";
				timerBar = new TimerBar(this, 800, 100);
			}
			if (index >= 7)
			{
				disableClick = true;
				coolDownTimer = getTimer();
				if (index == 7)
				{
					prime(0xE8A936);
				}
				else if (index == 9)
				{
					prime(0xE9DEC8);
				}
				else if (index == 11)
				{
					prime(0xC570FF);
				}
				else if (index == 13)
				{
					prime(0x000431);
				}
				else if (index == 15)
				{
					prime(0x484DA9);
				}
				
				if (index > 7 && index <= 23)
				{
					
					changeString += tooSlow + "*@" + timeDiff;
					changeString += "</set" + (index - 7) + ">";
					tooSlow = 0;
					if (index < 23)
					{
						picButton1.changePicture("assets/P" + (index - 6) + "a.jpg");
						picButton2.changePicture("assets/P" + (index - 6) + "b.jpg");
						changeString += "<set" + (index - 6) + ">";
					}
					xmlString += "<pair" + (index - 7) + ">" + favOrder[0] + "</pair" + (index - 7) + ">";
				}
				text1.changeText(0, 0, "", 1);
				instructions1.changeText(550, 20, "Pick your favorite picture", 30, 500);
				countdown = 5;
				//text3.changeText(700, 350, 40, countdown.toString());
				//if (index == 6)
				if (contains(frames))
					setChildIndex(frames, 1);
			}
			if (index == 23)
			{
				changeString += "</frames2></changes>";
				xmlString += "</pairs>";
				xmlString += changeString;
				xmlString += "</frames>";
				trace(xmlString);
				xmlData = new XML(xmlString);
				trace(xmlData);
				trace(xmlString);
				index++;
				postData();
			}
			resetValues();
			elapsedTime = getTimer();
			startTime = getTimer();
			//trace(changeString);
		}
		
		public function resetValues():void
		{
			favOrder[0] = 0;
			favOrder[1] = 0;
			favOrder[2] = 0;
			favOrder[3] = 0;
			favOrder[4] = 0;
		}
		
		public function clear():void
		{
			text1.changeText(0, 0, "", 1);
			text2.changeText(0, 0, "", 1);
			text4.changeText(0, 0, "", 1);
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				pictureDrags[i].remove();
			}
			instructions2.changeText(0, 0, "", 1);
			//button.hide();
		}
		
		private function prime(color:uint):void
		{
			setChildIndex(primeSprite, numChildren - 1);
			primeSprite.graphics.beginFill(color, 1);
			primeSprite.graphics.drawCircle(800, 400, 2000);
			primeSprite.graphics.endFill();
			isPriming = true;
			primeTimer = getTimer();
		}
		
		public function Click(e:MouseEvent = null):void
		{
			if (disableClick)
			{
				return;
			}
			if (index > 6)
			{
				if (e.stageX > 250 && e.stageX < 760 && e.stageY > 100 && e.stageY < 475)
				{
					favOrder[0] = "a";
					displayNext();
				}
				
				if (e.stageX > 835 && e.stageX < 1345 && e.stageY > 100 && e.stageY < 475)
				{
					favOrder[0] = "b";
					displayNext();
				}
			}
		}
		
		public function trackChange():void
		{
			changeString += "#";
			timeDiff = getTimer() - changeTime;
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				changeString += favOrder[i] + "-";
			}
			changeString = changeString.substring(0, changeString.length - 1);
			changeString += "@" + timeDiff;
			changeTime = getTimer();
			//trace(changeString);
		}
		
		public function trackTime():void
		{
			timeDiff = getTimer() - changeTime;
			changeString += "@" + timeDiff;
			changeTime = getTimer();
			//trace(changeString);
		}
		
		public function setOrder():void
		{
			for (var i:int = 0; i < favOrder.length; i++)
			{
				oldOrder[i] = favOrder[i];
			}
		}
		
		public function compareOrder():Boolean
		{
			for (var i:int = 0; i < favOrder.length; i++)
			{
				if (oldOrder[i] != favOrder[i])
				{
					return false;
				}
				
			}
			return true;
		}
		
		public function cont(e:Event = null):void
		{
			displayNext();
			stage.removeEventListener(MouseEvent.CLICK, cont);
		}
		
		public function setID(id:String):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostFramesHarris.php");
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "test-test393t30";
			phpVariables.ID = ID;
			xmlURLReq.data = phpVariables;
			xmlURLReq.method = URLRequestMethod.POST;
			var xmlSendLoad:URLLoader = new URLLoader();
			xmlSendLoad.addEventListener(Event.COMPLETE, onComplete, false, 0, true);
			xmlSendLoad.addEventListener(IOErrorEvent.IO_ERROR, onIOError, false, 0, true);
			xmlSendLoad.load(xmlURLReq);
			//navigateToURL(xmlURLReq,"_blank"); 
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
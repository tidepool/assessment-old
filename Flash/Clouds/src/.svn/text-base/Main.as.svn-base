package
{
	import flash.display.Bitmap;
	import flash.display.DisplayObject;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.utils.Timer;
	import flash.utils.getTimer;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	
	public class Main extends Sprite
	{
		private var instruction:Label;
		private var startTime:Number;
		private var xmlData:XML;
		private var lastTime:Number;
		private var picStrings:Array = new Array();
		private var orderArray:Array = new Array();
		private var background:Loader;
		private var promptBox:Loader;
		private var black:Loader;
		private var ID:String;
		private var sun:Picture;
		private var completionTime:Number = 9000;
		private var progressTime:Number = 0;
		private var index:int = 0;
		private var controls:CloudControls;
		private var clipMask:Sprite;
		private var nextButton:NextButton;
		private var balloonScreen:BalloonMain;
		
		public var prefix:String;
		public var xmlString:String;
		public var elapsedTime:Number;
		public var pictureButtons:Array = new Array();
		public var pickedPictures:Array = new Array(null, null, null, null, null, null);
		public var progressCounter:int = 0;
		public var velocity:Number;
		public var changeTime:Number;
		public var timeDiff:Number;
		public var changeString:String;
		public var preLoaded:Boolean = false;
		public var loadList:Array = new Array();
		
		public function Main():void
		{
			prefix = "http://s3.amazonaws.com/tidepool_flash/clouds/";
			//prefix = "";
			if (stage)
				init();
			else
				addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		public function displayWarning():void
		{
			promptBox = new Loader();
			promptBox.load(new URLRequest(prefix + "assets/promptBox.png"));
			loadList.push(promptBox);
			
			var label:Label = new Label(this, 250, 275, "In the following screen, click each cloud that interests you.\n You may change the speed of the clouds using the controls at the bottom.", 26, 1100, 1, 0x333333);
			
			var label2:Label = new Label(this, 250, 375, "(Click anywhere to continue when you are ready)", 20, 1100, 1, 0x888888);
			//var l:label = new label(this, 400, 300, ID, 35, 900);
			addChild(loadList.shift());
			addChild(loadList.shift());
			addChild(loadList.shift());
			run();
			stage.addEventListener(MouseEvent.CLICK, launch);
			graphics.beginFill(0xEEEEEE)
			graphics.drawCircle(800, 400, 900);
		}
		
		private function init(e:Event = null):void
		{
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
		}
		
		public function run(e:Event = null):void
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			addEventListener(Event.ENTER_FRAME, update);
			
			instruction = new Label(this, 300, 30, "Select each cloud that interests you", 30, 1000, 1, 0x333333);
			createFileNames();
			createOrder();
			
			black = new Loader();
			black.load(new URLRequest(prefix + "assets/black.jpg"));
			loadList.push(black);
			
			background = new Loader();
			background.load(new URLRequest(prefix + "assets/background.jpg"));
			loadList.push(background);
			
			/*
			   background = new Assets.background();
			   addChild(background);
			 */
			
			nextButton = new NextButton(this, 800, 770);
			controls = new CloudControls(this, 800, 700);
			sun = new Picture(this, 800, 700, "assets/sun.png", 125);
			
			for (var i:int = 1; i <= 33; i++)
			{
				var numIndex:int = orderArray.shift();
				trace(numIndex);
				pictureButtons.push(new Cloud(this, 250 - (500 * i), 175, picStrings[numIndex-1], i));
			}
			
			for (i = 34; i <= 66; i++)
			{
				numIndex = orderArray.shift();
				trace(numIndex);
				pictureButtons.push(new Cloud(this, 500 - ((i - 33) * 500), 425, picStrings[numIndex-1], i));
			}
			
			lastTime = 0;
			xmlString = "<clouds>";
			xmlString += "<pictures>";
			changeString = "<changes>";
			elapsedTime = 0;
			velocity = 0;
			createClippingMask();
		}
		
		private function launch(e:Event):void
		{
			stage.removeEventListener(MouseEvent.CLICK, launch);
			graphics.clear();
			
			while (numChildren > 0)
			{
				removeChildAt(0);
			}
			
			while (loadList.length > 0)
			{
				addChild(loadList.shift());
			}
			
			preLoaded = true;
			velocity = 2;
			controls.setCorrect();
		}
		
		private function createClippingMask():void
		{
			clipMask = new Sprite();
			clipMask.graphics.beginFill(0xEEEEEE);
			clipMask.graphics.drawRect(0, 0, -99999, 800);
			clipMask.graphics.drawRect(1600, 0, 99999, 800);
			clipMask.graphics.drawRect(0, 0, 1600, -99999);
			clipMask.graphics.drawRect(0, 800, 1600, 99999);
			clipMask.graphics.endFill();
			addChild(clipMask);
		}
		
		public function displayNext():void
		{
			index++;
			graphics.clear();
			while (numChildren > 0)
			{
				removeChildAt(0);
			}
			if (index == 1)
			{
				xmlString += "</pictures><balloon1>";
				changeString += "<speed>";
				changeString += controls.changes;
				changeString += "</speed><balloon1>";
				
				background.alpha = 1;
				addChild(background);
				balloonScreen = new BalloonMain(this, 1);
				nextButton.add();
				
			}
			else if (index == 2)
			{
				changeString += "</balloon1><balloon2>";
				balloonScreen.WriteXML();
				xmlString += "</balloon1><balloon2>";
				addChild(background);
				balloonScreen = new BalloonMain(this, 2);
				nextButton.add();
			}
			else
			{
				changeString += "</balloon2>";
				balloonScreen.WriteXML();
				xmlString += "</balloon2>";
				changeString += "</changes>";
				xmlString += changeString;
				xmlString += "</clouds>";
				xmlData = new XML(xmlString);
				trace(xmlData);
				trace(xmlString);
				postData();
			}
		}
		
		private function update(e:Event):void
		{
			if (progressCounter == 65)
			{
				if (index == 0)
				{
					displayNext();
				}
			}
			
			if (balloonScreen != null)
			{
				balloonScreen.update();
			}
			if (index == 0)
			{
				progressTime += velocity / 2;
				if (progressTime / completionTime < 0.5)
				{
					background.alpha = progressTime / completionTime * 2 + 0.5;
				}
				else
				{
					background.alpha = (completionTime - progressTime) / completionTime * 2 + 0.5;
				}
				for (var i:int = 0; i < pictureButtons.length; i++)
				{
					if (pictureButtons[i].positionX > 1900)
					{
						pictureButtons[i].nowShown();
					}
					else
					{
						pictureButtons[i].update(velocity);
							//pictureButtons[i].sprite
					}
				}
				if (contains(sun.sprite))
				{
					moveSun();
					setChildIndex(sun.sprite, 1);
					sun.update();
				}
				if (contains(background))
				{
					setChildIndex(background, 0);
				}
				if (contains(black))
				{
					setChildIndex(black, 0);
				}
			}
			if (contains(clipMask))
			{
				setChildIndex(clipMask, numChildren - 1);
			}
			else
			{
				addChild(clipMask);
			}
		}
		
		private function moveSun():void
		{
			var centerX:Number = 800;
			var centerY:Number = 775;
			var radius:Number = 750;
			
			var radians:Number;
			radians = (progressTime / completionTime) * Math.PI;
			
			sun.positionX = centerX - (radius * Math.cos(radians));
			sun.positionY = centerY - (radius * Math.sin(radians));
		}
		
		public function getFileNumber():int
		{
			var i:int = Math.random() * picStrings.length;
			return i;
		}
		
		public function changeVelocity(vel:int):void
		{
			velocity = vel;
		}
		
		public function setID(id:String):void
		{
			ID = id;
			displayWarning();
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostCloudsHarris.php");
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "test-775417";
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
			if (ExternalInterface.available)
			{
				ExternalInterface.call("sendToJavaScript", xmlString);
			}
			else
			{
				/*
				   while (numChildren > 0)
				   {
				   removeChildAt(0);
				   }
				 */
			}
		}
				private function createOrder()
		{
			orderArray.push(2);
			orderArray.push(29);
			orderArray.push(21);
			orderArray.push(32);
			orderArray.push(56);
			orderArray.push(41);
			orderArray.push(17);
			orderArray.push(57);
			orderArray.push(14);
			orderArray.push(11);
			orderArray.push(19);
			orderArray.push(64);
			orderArray.push(26);
			orderArray.push(33);
			orderArray.push(37);
			orderArray.push(59);
			orderArray.push(63);
			orderArray.push(10);
			orderArray.push(54);
			orderArray.push(30);
			orderArray.push(62);
			orderArray.push(66);
			orderArray.push(52);
			orderArray.push(7);
			orderArray.push(39);
			orderArray.push(1);
			orderArray.push(65);
			orderArray.push(20);
			orderArray.push(58);
			orderArray.push(44);
			orderArray.push(43);
			orderArray.push(45);
			orderArray.push(5);
			orderArray.push(15);
			orderArray.push(42);
			orderArray.push(35);
			orderArray.push(34);
			orderArray.push(46);
			orderArray.push(36);
			orderArray.push(49);
			orderArray.push(47);
			orderArray.push(24);
			orderArray.push(22);
			orderArray.push(50);
			orderArray.push(25);
			orderArray.push(61);
			orderArray.push(51);
			orderArray.push(60);
			orderArray.push(40);
			orderArray.push(23);
			orderArray.push(13);
			orderArray.push(3);
			orderArray.push(6);
			orderArray.push(8);
			orderArray.push(12);
			orderArray.push(55);
			orderArray.push(38);
			orderArray.push(4);
			orderArray.push(27);
			orderArray.push(53);
			orderArray.push(16);
			orderArray.push(28);
			orderArray.push(48);
			orderArray.push(31);
			orderArray.push(18);
			orderArray.push(9);		
		}
		
		public function createFileNames():void
		{
			picStrings.push("Arrange or compose music of any kind_1");
			picStrings.push("Create portraits or photographs_2");
			picStrings.push("Design fashion, furniture, interiors, or posters_3");
			picStrings.push("Perform for Others_4");
			picStrings.push("Play in a band, group, or orchestra_5");
			picStrings.push("Practice a musical Instrument_6");
			picStrings.push("Read artistic, literary, or musical articles_7");
			picStrings.push("Sketch, draw, or paint_8");
			picStrings.push("Take an Art course_9");
			picStrings.push("Work with a gifted artist, writer, or sculptor_10");
			picStrings.push("Write novels or plays_11");
			
			picStrings.push("Add, subtract, multiply, and divide numbers in business or bookkeeping_12");
			picStrings.push("Check paperwork or products for errors or flaws_13");
			picStrings.push("Fill out income tax forms_14");
			picStrings.push("Keep detailed records of expenses_15");
			picStrings.push("Operate office machines_16");
			picStrings.push("Set up a record-keeping system_17");
			picStrings.push("Take a Commercial Math Course_18");
			picStrings.push("Take an Accounting Course_19");
			picStrings.push("Take an inventory of supplies_20");
			picStrings.push("Update records or files_21");
			picStrings.push("Work in an office_22");
			
			picStrings.push("Act as an organizational or business consultant_23");
			picStrings.push("Attend sales conferences_24");
			picStrings.push("Lead a group in accomplishing some goal_25");
			picStrings.push("Learn strategies for business success_26");
			picStrings.push("Meet important executives and leaders_27");
			picStrings.push("Operate my own service or business_28");
			picStrings.push("Participate in a political campaign_29");
			picStrings.push("Read business magazines or articles_30");
			picStrings.push("Serve as an officer of any group_31");
			picStrings.push("Supervise the work of others_32");
			picStrings.push("Take a short course on administration or leadership_33");
			
			picStrings.push("Apply mathematics to practical problems_34");
			picStrings.push("Read scientific books or magazines_35");
			picStrings.push("Study a scientific theory_36");
			picStrings.push("Study scholarly or technical problems_37");
			picStrings.push("Take a Biology Course_38");
			picStrings.push("Take a Chemistry Course_39");
			picStrings.push("Take a Mathematics course_40");
			picStrings.push("Take a Physics course_41");
			picStrings.push("Work in a research office or laboratory_42");
			picStrings.push("Work on a scientific project_43");
			picStrings.push("Work with chemicals_44");
			
			picStrings.push("Build things with wood_45");
			picStrings.push("Fix electrical things_46");
			picStrings.push("Fix mechanical things_47");
			picStrings.push("Operate motorized machines or equipment_48");
			picStrings.push("Repair cars_49");
			picStrings.push("Take a Mechanical Drawing course_50");
			picStrings.push("Take a Technology Education (e.g. Industrial Arts, Shop) course_51");
			picStrings.push("Take a Woodworking Course_52");
			picStrings.push("Take an Auto Mechanics course_53");
			picStrings.push("Work outdoors_54");
			picStrings.push("Work with an outstanding mechanic or technician_55");
			
			picStrings.push("Help others with their personal problems_56");
			picStrings.push("Meet important educators or therapists_57");
			picStrings.push("Read Psychology Books or Articles_58");
			picStrings.push("Read Sociology Articles or Books_59");
			picStrings.push("Study juvenile delinquency_60");
			picStrings.push("Supervise activities for mentally ill patients_61");
			picStrings.push("Take a Human Relations course_62");
			picStrings.push("Teach adults_63");
			picStrings.push("Teach in a high school_64");
			picStrings.push("Work as a volunteer_65");
			picStrings.push("Work for a charity_66");
		}
	
	}

}
package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.utils.getTimer;
	
	public class Main extends Sprite
	{
		public var sliders:Array = new Array();
		public var bar:DragBar;
		public var index:int;
		public var sliderIndex:int;
		public var label:Label;
		public var l1:Label;
		public var l2:Label;
		public var arrowPic:Picture;
		public var prefix:String;
		public var elapsedTime:Number;
		public var timeDiff:Number;
		public var changeString:String;
		public var xmlString:String;
		public var nextButton:NextButton;
		
		private var taskTime:Number;
		private var ID:String;
		private var xmlData:XML;
		private var balloonScreen:BalloonMain;
		private var background:Loader;
		
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
			run();
		}
		
		public function run():void
		{
			addEventListener(Event.ENTER_FRAME, update);
			
			index = 0;
			sliderIndex = 0;
			label = new Label(this, 300, 25, "Generally speaking, how strongly do you value:");
			label.changeText(300, 25, 30, "Generally speaking, how strongly do you value:");
			label.changeWidth(1000);
			//	new picture(this,0,0,prefix + "assets/values/nextButton.png",0);
			nextButton = new NextButton(this, 800, 770);
			
			background = new Loader();
			background.load(new URLRequest(prefix + "assets/background.jpg"));
			addChild(background);
			
			l1 = new Label(this, 450, 150, "");
			l2 = new Label(this, 450, 150, "");
			xmlString = "<values>";
			nextPictureSlider();
			
			elapsedTime = getTimer();
			taskTime = getTimer();
		}
		
		public function nextPictureSlider():void
		{
			if (index == 0)
			{
				nextButton.remove();
				timeDiff = getTimer() - taskTime;
				taskTime = getTimer();
				switch (sliderIndex)
				{
					case 0: 
						xmlString += "<independent>";
						changeString = "<changes>";
						sliders.push(new SliderPlate(this, 800, 350, "assets/1.jpg", "Achievement", 500, 1));
						//trace ("hre");
						break;
					case 1: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/2.jpg", "Challenge", 500, 2));
						sliders[0].hide();
						changeString += "<achievement>" + sliders[0].slider.changes + "</achievement>";
						xmlString += "<achievement>" + sliders[0].slider.percentage + "</achievement>";
						break;
					case 2: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/3.jpg", "Independence", 500, 3));
						sliders[1].hide();
						xmlString += "<challenge>" + sliders[1].slider.percentage + "</challenge>";
						changeString += "<challenge>" + sliders[1].slider.changes + "</challenge>";
						break;
					case 3: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/4.jpg", "Money", 500, 4));
						sliders[2].hide();
						xmlString += "<independence>" + sliders[2].slider.percentage + "</independence>";
						changeString += "<independence>" + sliders[2].slider.changes + "</independence>";
						break;
					case 4: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/5.jpg", "Power", 500, 5));
						sliders[3].hide();
						xmlString += "<money>" + sliders[3].slider.percentage + "</money>";
						changeString += "<money>" + sliders[3].slider.changes + "</money>";
						break;
					case 5: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/6.jpg", "Recognition", 500, 6));
						sliders[4].hide();
						xmlString += "<power>" + sliders[4].slider.percentage + "</power>";
						changeString += "<power>" + sliders[4].slider.changes + "</power>";
						break;
					case 6: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/7.jpg", "Service to Others", 500, 7));
						sliders[5].hide();
						xmlString += "<recognition>" + sliders[5].slider.percentage + "</recognition>";
						changeString += "<recognition>" + sliders[5].slider.changes + "</recognition>";
						break;
					case 7: 
						sliders.push(new SliderPlate(this, 800, 350, "assets/8.jpg", "Variety", 500, 8));
						sliders[6].hide();
						xmlString += "<service>" + sliders[6].slider.percentage + "</service>";
						changeString += "<service>" + sliders[6].slider.changes + "</service>";
						break;
					case 8: 
						sliders[7].hide();
						displayNext();
						xmlString += "<variety>" + sliders[7].slider.percentage + "</variety>";
						changeString += "<variety>" + sliders[7].slider.changes + "</variety>";
						changeString += "</changes>";
						xmlString += changeString;
						xmlString += "</independent>";
						changeString = "<changes>";
						break;
				}
				trace(changeString);
				sliderIndex++;
			}
			else
			{
				displayNext();
			}
		}
		
		public function update(e:Event):void
		{
			for (var i:int = 0; i < sliders.length; i++)
			{
				sliders[i].update();
			}
			if (bar != null)
			{
				bar.update();
			}
			
			if (balloonScreen != null)
			{
				balloonScreen.update();
			}
			
			if (contains(background))
				setChildIndex(background, 0);
		}
		
		public function displayNext():void
		{
			timeDiff = getTimer() - taskTime;
			taskTime = getTimer();
			if (index == 0)
			{
				
				sliders.sortOn("value", Array.NUMERIC);
				for (var i:int = 0; i < sliders.length; i++)
				{
					sliders[i].pic.resize(150);
					sliders[i].sendShuttle();
				}
				label.changeText(300, 150, 30, "Is this how you would rank the importance of each of these values? If not, select and slide to the correct ranking.");
				l1.changeText(100, 600, 30, "Lower");
				l1.changeWidth(100);
				l2.changeText(1400, 600, 30, "Higher");
				l2.changeWidth(100);
			}
			else if (index == 1)
			{
				label.changeText(0, 0, 0, "");
				
				if (bar.changed)
				{
					changeString = changeString.substring(0, changeString.length - 3);
				}
				trace(changeString);
				xmlString += "<order>";
				xmlString += "<choice1>" + bar.pictureDrags[0].type + "</choice1>";
				xmlString += "<choice2>" + bar.pictureDrags[1].type + "</choice2>";
				xmlString += "<choice3>" + bar.pictureDrags[2].type + "</choice3>";
				xmlString += "<choice4>" + bar.pictureDrags[3].type + "</choice4>";
				xmlString += "<choice5>" + bar.pictureDrags[4].type + "</choice5>";
				xmlString += "<choice6>" + bar.pictureDrags[5].type + "</choice6>";
				xmlString += "<choice7>" + bar.pictureDrags[6].type + "</choice7>";
				xmlString += "<choice8>" + bar.pictureDrags[7].type + "</choice8>";				
				changeString += " *@" + timeDiff + " </changes>";
				xmlString += changeString;
				xmlString += "</order>";
				xmlString += "<percentages>";
				changeString = "<changes>";
				if (bar == null)
					return;
				l1.changeText(0, 600, 30, "");
				l2.changeText(1450, 600, 30, "");
				if (bar != null)
					bar.remove();					
				balloonScreen = new BalloonMain(this,1);
				nextButton.add();
			}
			else
			{				
				balloonScreen.WriteXML();
				changeString += " *@" + timeDiff + " </changes>";			
				xmlString += changeString;
				xmlString += "</percentages>";
				xmlString += "</values>";
				xmlData = new XML(xmlString);
				trace(xmlData);
				trace(xmlString);
				nextButton.remove();
				postData();
			}
			index++;
		}
		
		public function click(e:Event):void
		{
			nextPictureSlider();
		}
		
		public function addBar():void
		{
			if (bar == null)
			{
				bar = new DragBar(this);
				for (var i:int = 0; i < sliders.length; i++)
				{
					bar.addPictureDrag(i * 200 + 50, 500, sliders[i].string, sliders[i].string, sliders[i].string, sliders[i].index);
				}
				bar.setInitial();
			}
			nextButton.add();
		}
		
		public function setID(id):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostViolin.php");
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "test--abh6ae16ab1";
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
			{
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
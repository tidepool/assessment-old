package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.utils.getTimer;
	
	public class Main extends Sprite
	{
		public var cells:Array = new Array();
		public var points:Array = new Array();
		public var selected:Array = new Array();
		
		public var hints:Array = new Array();
		
		public var bg:Picture;
		public var currentAlpha:Number = 0;
		public var shouldDisplayHint:Boolean = false;
		public var hintBox:MessageBox;
		public var elapsedTime:Number = 0;
		public var prefix:String;
		public var changeString:String;
		public var taskTime:Number;
		public var timeDiff:Number;
		public var rockValues:Array;
		
		private var xmlIndex:int = 1;
		private var xmlString:String;
		private var year1Text:Label;
		private var year2Text:Label;
		private var year3Text:Label;
		private var ID:String;
		private var hintSprite:Sprite;
		private var nextButton:NextButton;
		
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
			nextButton = new NextButton(this, 1450, 750);
			rockValues = new Array(-1, -1, -1, -1, -1, -1, -1, -1, -1);
			
			bg = new Picture(this, 800, 400, "assets/bg.jpg", 1600);
			
			cells.push(new CellKit(this, 100, 75, "1.png", "Benefits", "Group insurance, Retirement, Profit-sharing, Fringe benefits", 1));
			cells.push(new CellKit(this, 275, 75, "2.png", "Training", "Skill-based training, Certification programs", 2));
			cells.push(new CellKit(this, 450, 75, "3.png", "Money", "Salary, Wages, Equity, Overtime, Bonuses, Housing/Auto Allowance", 3));
			cells.push(new CellKit(this, 625, 75, "4.png", "Support", "IT and admin support needed to do my job well", 4));
			cells.push(new CellKit(this, 800, 75, "5.png", "Appreciation", "Meaningful demonstrations from management to me and my peers that our work is of value to the company", 5));
			cells.push(new CellKit(this, 975, 75, "6.png", "Advancement", "Fair opportunities to be promoted", 6));
			cells.push(new CellKit(this, 1150, 75, "7.png", "Credit", "Recognition for the Intellectual Property, Copyrights, Trademarks, Patents and other unique contributions I make for the company", 7));
			cells.push(new CellKit(this, 1325, 75, "8.png", "Time Off", "Reasonable work hours, Weekends off, Paid Time Off, Vacations, Time away from email", 8));
			cells.push(new CellKit(this, 1500, 75, "9.png", "Education", "Opportunity to go to school and earn a degree", 9));
			
			var d:Number = -50;
			points.push(new Rectangle(125, 720 + d, 1, 0));
			points.push(new Rectangle(280, 650 + d, 2, 0));
			points.push(new Rectangle(460, 625 + d, 3, 0));
			
			points.push(new Rectangle(620, 585 + d, 4, 0));
			points.push(new Rectangle(780, 580 + d, 5, 0));
			points.push(new Rectangle(940, 615 + d, 6, 0));
			
			points.push(new Rectangle(1115, 590 + d, 7, 0));
			points.push(new Rectangle(1300, 550 + d, 8, 0));
			points.push(new Rectangle(1450, 495 + d, 9, 0));
			
			for (var i:int = 0; i < points.length; i++)
			{
				new Picture(this, points[i].x, points[i].y, "assets/stepHolder.png", 100);
			}
			
			hintSprite = new Sprite();
			addChild(hintSprite);
			
			drawHint();
			changeString = "<changes>";
			taskTime = getTimer();
		}
		
		public function drawHint():void
		{
			for (var i:int = 0; i < points.length; i++)
			{
				hints.push(new Point(points[i].x, points[i].y));
			}
			year1Text = new Label(this, 300, 685, "1st Year", 30);
			year1Text.changeColor(0xF41A1A)
			year2Text = new Label(this, 750, 600, "2nd Year", 30);
			year2Text.changeColor(0x26861A)
			year3Text = new Label(this, 1350, 575, "3rd Year", 30);
			year3Text.changeColor(0x342FE8)
			
			hintBox = new MessageBox(this, 425, 650, 750, "Drag and drop the stones to create a plan. What incentives will help you achieve your goal over the next three years?\n\n(You may use stones more than once)");
		}
		
		public function update(e:Event):void
		{
			updateHint();
			if (contains(bg.sprite))
			{
				setChildIndex(bg.sprite, 0);
			}
			for (var i:int = 0; i < cells.length; i++)
			{
				cells[i].update();
			}
			for (i = 0; i < selected.length; i++)
			{
				selected[i].update();
			}
			hintBox.update();
		}
		
		public function updateHint():void
		{
			if (contains(bg.sprite))
			{
				setChildIndex(bg.sprite, 0);
			}
			if (shouldDisplayHint)
			{
				if (currentAlpha < 1)
				{
					currentAlpha += 0.01;
				}
				if (getTimer() - elapsedTime > 4000)
				{
					elapsedTime = getTimer();
					shouldDisplayHint = false;
				}
			}
			else
			{
				if (currentAlpha > 0)
				{
					currentAlpha -= 0.01;
				}
				if (getTimer() - elapsedTime > 4000)
				{
					elapsedTime = getTimer();
					shouldDisplayHint = true;
				}
			}
			setHintAlpha(currentAlpha);
		}
		
		public function trackChange(rock:String):void
		{
			if (points.length == 0)
			{
				nextButton.add();
			}
			else
			{
				nextButton.remove();
			}		
			
			timeDiff = getTimer() - taskTime;
			taskTime = getTimer();
			changeString += "#" + rock + "@" + timeDiff;
			trace(changeString);
		}		
		
		public function recordClick(rock:String):void
		{
			timeDiff = getTimer() - taskTime;
			taskTime = getTimer();
			changeString += "*" + rock + "@" + timeDiff;
			trace(changeString);
		}
		
		public function writeXML():void
		{
			timeDiff = getTimer() - taskTime;
			taskTime = getTimer();
			
			xmlString = "<pathway>";
			for (var i:int = 0; i < 9; i++)
			{
				xmlString += "<r" + (i + 1) + ">" + rockValues[i] + "</r" + (i + 1) + ">";
			}
			changeString += "</changes>";
			xmlString += changeString;
			xmlString += "</pathway>";
			var xmlData:XML = new XML(xmlString);
			trace(xmlData);
			trace(xmlString);
			postData();
			//xmlIndex = 1;
			//trace(xmlString);
			//trace(changeString);
		}
		
		public function setHintAlpha(p_alpha:Number):void
		{
			hintSprite.graphics.clear();
			var width:Number = 125;
			var length:Number = 75;
			for (var i:int = 0; i < 9; i++)
			{
				if (i < 3)
				{
					hintSprite.graphics.lineStyle(5, 0xF41A1A, p_alpha);
				}
				else if (i < 6)
				{
					hintSprite.graphics.lineStyle(5, 0x26861A, p_alpha);
				}
				else
				{
					hintSprite.graphics.lineStyle(5, 0x342FE8, p_alpha);
				}
				hintSprite.graphics.drawEllipse(hints[i].x - width / 2, hints[i].y - length / 2, width, length);
				hintSprite.graphics.endFill();
			}
			year1Text.changeAlpha(p_alpha);
			year2Text.changeAlpha(p_alpha);
			year3Text.changeAlpha(p_alpha);
		}
		
		public function setID(id):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostPathway.php");
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "56358bh6eer153";
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
				while (numChildren > 0)
				{
					removeChildAt(0);
				}
			}
		}
	}
}

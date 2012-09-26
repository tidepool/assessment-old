package 
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	import flash.utils.getTimer;
	
	/**
	 * ...
	 * @author Wei
	 */
	public class Main extends Sprite 
	{
		public var list:List;
		public var companyList:List;
		public var graph:RadarGraph;
		private var l:Label;
		private var xmlString:String;
		public var users:Array;
		public var currentUser:UserData;
		private var header:HeaderBar;
		
		private var red:Picture;
		
		public var testPic:Picture;
		public var compare:ComparePage;
		
		public var graphData:GraphData;
		private var Borders:Sprite = new Sprite();
		
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			addChild(Borders);
			users = new Array();			
			list = new List(this, 128, 102, 700, 100);
			red = new Picture(this, 0, 0, "assets/redLine.png", 100, false);
			red.sprite.scaleX = 800 / 104;
			red.sprite.scaleY = 50 / 45;
			companyList = new List(this, 935, 490,800,70);
			companyList.setScale(800,70);
			companyList.addCompany("Tidepool","assets/tidepool.png","7 employees share your resilience","http://www.tidepool.co");
			companyList.addCompany("SalesForce","assets/salesforce.png","13 employees share your motivation","http://www.salesforce.com/company/careers/");
			companyList.addCompany("Beachmint","assets/beachmint.png","43 employees share your conscientiousness","http://www.beachmint.com/jobs.html");
			companyList.addCompany("Zappos","assets/zappos.png","37 employees share your openness","http://about.zappos.com/jobs");
			companyList.addCompany("Genentech","assets/genentech.png","63 employees share your values","http://www.gene.com/gene/careers/");
			companyList.showAll();			
			var co:Label = new Label(companyList.sprite, 1230, 420, "Companies you might thrive with:");
			co.text.textColor = 0xFFFFFF;
			graph = new RadarGraph(this, 1200, 222, 160);
			graphics.beginFill(0xD8E2E6, 1);
			graphics.drawCircle(800, 400, 1400);
			graphics.endFill();
			
			graphics.beginFill(0xC0504D, 1);
			graphics.drawRect(800, 400, 800,55);
			graphics.endFill();
			
			graphics.beginFill(0xFFFFFF, 1);
			graphics.drawRect(800, 0, 800,400);
			graphics.endFill();
			

			
			stage.addEventListener(MouseEvent.MOUSE_WHEEL, rolled);			
			stage.addEventListener(MouseEvent.CLICK, click);
			
			if (ExternalInterface.available) 
			{
				ExternalInterface.addCallback("recieveValues", setValue);
				ExternalInterface.call("getValues", " ");
			}
			else
			{
				xmlString = "TESTING";
				offline();
			}
			
		}
		public function setValue(s:String):void
		{
			xmlString = s;
			var counter:int = 0;
			
			var usersXML:XML = new XML(s);		
			var user:XML;
			var name:String;
			var pic:String;
			var worktype:String;			
			var frames:String;		
			var interest:String;	
			var desc:String;
			
			name = usersXML.taker.name.text();
			pic = usersXML.taker.pic.text();
			frames = usersXML.taker.frames.text();
			interest = usersXML.taker.interest.text();
			worktype = usersXML.taker.worktype.text();
			currentUser = new UserData(this, name, pic, "", worktype, "", interest, frames, 37);			
			var temp:Array = frames.split(/,/);
			graph.setIdeal(temp);
			list.addItem(currentUser);
			for (var i:int = 0; i < usersXML.user.length(); i++) 
			{
				user = usersXML.user[i];
				name = user.name.text();
				pic = user.pic.text();
				worktype = user.worktype.text();
				frames = user.frames.text();				
				interest = user.interest.text();
				desc = user.desc.text();
				//new label(this, 800, (i * 100)-50, "Name: " + name, 14, 1000);
				//l = new label(this, 500, (i * 100)-25, "Pic: " + pic, 14, 1000);	
				//new label(this, 800, (i * 100), "Job: " + user.job.text(), 14, 1000);	
				users.push(new UserData(this, name, pic, "", worktype, desc, interest, frames, -99));
				//users[i].PrintOut((i * 50) + 50);
				list.addItem(users[i]);
				if (i == 1)
				{
					list.addAd("28 people who share your personality have checked-in at Pink Taco.","https://foursquare.com/v/pink-taco/47ed4758f964a5206a4e1fe3");
				}
				if (i == 3)
				{
					list.addAd("Are you traveling soon? 14 people with your personality have checked-in at Parc 55 Wyndham in San Francisco, CA.","https://foursquare.com/v/parc-55-wyndham-hotel/43c3ed00f964a520562d1fe3");
				}
			}
			run();
		}
		private function offline():void
		{
			var string:String = "12,8,6,2,4";			
			currentUser = new UserData(this, "Kabir", "assets/circle.png", "", "LAf", "", "", string, 37);
			var temp:Array = string.split(/,/);
			graph.setIdeal(temp);
			
			var u1:UserData = new UserData(this,"Deborah","assets/circle.png","tidepool","LCS","I'm wei","","4,3,3,5,3",37);
			var u2:UserData = new UserData(this,"Galen","assets/circle.png","tidepool","HES","I'm wei","","4,3,3,5,3",37);
			var u3:UserData = new UserData(this, "Rhett", "assets/circle.png", "tidepool", "LCw", "I'm wei", "", "4,3,3,5,3", 37);
			var u4:UserData = new UserData(this, "Kabir", "assets/circle.png", "tidepool", "HAd", "I'm wei", "", "4,3,3,5,3", 37);
			list.addItem(currentUser);
			list.addItem(u1);
			list.addItem(u2);
			list.addAd("28 people who share your personality have checked-in at Pink Taco.","https://foursquare.com/v/pink-taco/47ed4758f964a5206a4e1fe3");
			list.addItem(u3);
			list.addAd("Are you traveling soon? 14 people with your personality have checked-in at Parc 55 Wyndham in San Francisco, CA.","https://foursquare.com/v/parc-55-wyndham-hotel/43c3ed00f964a520562d1fe3");
			list.addItem(u1);
			list.addItem(u2);
			list.addAd("Are you traveling soon? 14 people with your personality have checked-in at Parc 55 Wyndham in San Francisco, CA.","https://foursquare.com/v/parc-55-wyndham-hotel/43c3ed00f964a520562d1fe3");
			list.addItem(u3);
			list.addItem(u1);
			list.addItem(u2);
			list.addItem(u3);
			list.addItem(u4);
			users.push(u1);
			users.push(u2);
			users.push(u3);
			run();
		}
		
		private function run():void 
		{
		//	new Button(this,300,300,"ergerg");
			addEventListener(Event.ENTER_FRAME, update);
			
			
			
			//list.addItem(currentUser);
			trace(currentUser);
			list.show();
			//l = new label(this, 50, 50, xmlString, 14, 1000);
			header = new HeaderBar(this);
			//graph.setOriginalValue(76,83,73);
			graph.addLines();
		//	graph.showPolygon(77,88,99);
			
			
			compare = new ComparePage(this, 1200, 700);
			
		}		
		
		public function drawBorders():void
		{
			Borders.graphics.beginFill(0x000000);
			Borders.graphics.lineStyle(2, 0x000000, 1);
			
			Borders.graphics.moveTo(0, 50);
			Borders.graphics.lineTo(1600, 50);			
			
			Borders.graphics.moveTo(800, 50);
			Borders.graphics.lineTo(800, 800);			
			
			Borders.graphics.moveTo(800, 400);
			Borders.graphics.lineTo(1600, 400);
			setChildIndex(Borders, numChildren - 1);
		}		
		public function rolled(e:MouseEvent):void
		{
			trace(e.delta)
			if (e.delta < 0)
			{
				//list.listShift(1);
			}
			else
			{
				//list.listShift(-1);
			}
		}
		public function click(e:MouseEvent):void
		{
			trace("clicked")
		}
		
		private function update(e:Event):void
		{
			header.update();
			if (contains(red.sprite))
			{
				setChildIndex(red.sprite,numChildren-1);
			}			
			drawBorders();
		}
		
		public function hideCompany():void
		{
			companyList.hide();
		}
	}	
}
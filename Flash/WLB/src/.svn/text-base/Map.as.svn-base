package
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	
	public class Map
	{
		private var main:Main;
		private var map:pictureButton1;
		private var cursor:Array = new Array();
		private var cursorsAdded:Array = new Array();
		private var areas:Array = new Array();
		private var areaBMD:Array = new Array();
		private var index:int;
		private var modify:picture;
		private var modifyOver:picture;
		private var add:picture;
		private var addOver:picture;
		private var isModify:Boolean = false;
		private var mapContent:pictureButton1;
		private var buttonsSet:Boolean;
		
		public var buttons:Array = new Array();
		
		public function Map(p_main:Main)
		{
			main = p_main;
		
		}
		
		public function render():void
		{
			loadAreas();
			cursor.push(new pictureButton1(main, -100, 0, "assets/Map/black-thumbtack.png", "", 0.5, false));
			cursor.push(new pictureButton1(main, -100, 0, "assets/Map/blue-thumtack-(small).png", "", 0.5, false));
			cursor.push(new pictureButton1(main, -100, 0, "assets/Map/green-thumbtack.png", "", 0.5, false));
			cursor.push(new pictureButton1(main, -100, 0, "assets/Map/red-thumbtack.png", "", 0.5, false));
			cursor.push(new pictureButton1(main, -100, 0, "assets/Map/yellow-thumbtack.png", "", 0.5, false));
			
			buttons.push(new CheckButton(main, this, 100, 200));
			buttons.push(new CheckButton(main, this, 100, 300));
			buttons.push(new CheckButton(main, this, 100, 400));
			while (main.numChildren > 0)
			{
				main.removeChildAt(0);
			}
			mapContent = new pictureButton1(main, 400, 150, "assets/Map/Map.jpg");
			map = new pictureButton1(main, 400, 150, "assets/Map/mask.png");
			map.sprite.addEventListener(MouseEvent.CLICK, click);
			map.sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			map.sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			
			new label(main, 150, 200, "1 to 5 times", 25, 250, 0, false);
			new label(main, 150, 300, "6 to 10 times", 25, 250, 0, false);
			new label(main, 150, 400, "11 or more times", 25, 250, 0, false);
			
			new label(main, 400, 50, "Indicate on the map which region you have traveled for work within the past 5 years or less");
			addOver = new picture(main, 400, 700 + 60, "assets/addButton-over.png", 163);
			add = new picture(main, 400, 700 + 60, "assets/addButton.png", 163);
			addOver.sprite.addEventListener(MouseEvent.CLICK, setAdd);
			add.sprite.addEventListener(MouseEvent.MOUSE_OVER, addRollOver);
			addOver.sprite.addEventListener(MouseEvent.MOUSE_OUT, addOut);
			
			modifyOver = new picture(main, 600, 700 + 60, "assets/modifyButton-over.png", 163);
			modify = new picture(main, 600, 700 + 60, "assets/modifyButton.png", 163);
			modify.sprite.addEventListener(MouseEvent.MOUSE_OVER, modifyRollOver);
			modifyOver.sprite.addEventListener(MouseEvent.MOUSE_OUT, modifyOut);
			modifyOver.sprite.addEventListener(MouseEvent.CLICK, setModify);
			index = 2;
			isModify = false;
			buttonsSet = false;
			buttons[0].isSelected = true;
		}
		
		public function addRollOver(e:Event):void
		{
			main.setChildIndex(addOver.sprite, main.numChildren - 1);
		}
		
		public function addOut(e:Event):void
		{
			main.setChildIndex(add.sprite, main.numChildren - 1);
		}
		
		public function modifyRollOver(e:Event):void
		{
			main.setChildIndex(modifyOver.sprite, main.numChildren - 1);
		}
		
		public function modifyOut(e:Event):void
		{
			main.setChildIndex(modify.sprite, main.numChildren - 1);
		}
		
		public function update():void
		{
			if (!buttonsSet && main.contains(modify) && main.contains(add))
			{
				buttonsSet = true;
				main.setChildIndex(modifyOver, 0);
				main.setChildIndex(addOver, 0);
			}
			
			if (buttons[0].isSelected)
			{
				index = 1;
			}
			else if (buttons[1].isSelected)
			{
				index = 2;
			}
			else if (buttons[2].isSelected)
			{
				index = 3;
			}
			
			if (isModify)
			{
				if (main.contains(map.sprite))
				{
					main.setChildIndex(map.sprite, 0);
				}
			}
			else
			{
				if (main.contains(map.sprite))
				{
					main.setChildIndex(map.sprite, main.numChildren - 1);
				}
			}
		
		}
		
		public function keyPress():void
		{
		
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
		
		public function move(e:Event):void
		{
			if (!main.contains(cursor[index].sprite))
			{
				main.addChild(cursor[index].sprite);
			}
			cursor[index].sprite.x = main.mouseX - 32;
			cursor[index].sprite.y = main.mouseY - 50;
			Mouse.hide();
			
			var flag:Boolean = false;
			
			for (var i:int = 0; i < areas.length; i++)
			{
				var a:BitmapData;
				//	if (areas[i].bmd(new Point(400, 150),0.5,new Point(main.mouseX,main.mouseY),new Point(0,0)))
				if (areas[i].bmd.getPixel(main.mouseX - 400, main.mouseY - 150) != 0)
				{
					if (main.contains(areas[i].sprite))
					{
						main.setChildIndex(areas[i].sprite, main.numChildren - 1);
					}
					
					flag = true;
				}
				else
				{
					if (main.contains(areas[i].sprite))
					{
						main.setChildIndex(areas[i].sprite, 0);
					}
				}
			}
			
			for (i = 0; i < cursorsAdded.length; i++)
			{
				if (main.contains(cursorsAdded[i].sprite))
				{
					main.setChildIndex(cursorsAdded[i].sprite, main.numChildren - 1);
				}
			}
			if (main.contains(cursor[index].sprite))
			{
				main.setChildIndex(cursor[index].sprite, main.numChildren - 1);
			}
			if (main.contains(map.sprite))
			{
				main.setChildIndex(map.sprite, main.numChildren - 1);
			}
		
		}
		
		public function out(e:Event):void
		{
			main.removeChild(cursor[index].sprite);
			Mouse.show();
		}
		
		public function click(e:Event):void
		{
			var p:pictureButton1 = new pictureButton1(main, main.mouseX - 32, main.mouseY - 50, cursor[index].string, "", 0.5);
			var num:int;
			if (index == 1)
			{
				num = 1;
			}
			else if (index == 2)
			{
				num = 3;
			}
			else if (index == 3)
			{
				num = 5;
			}
			for (var i:int; i < num; i++)
			{
				cursorsAdded.push(p);
			}
			main.addChild(p);
			p.sprite.addEventListener(MouseEvent.MOUSE_DOWN, drag);
			p.sprite.addEventListener(MouseEvent.MOUSE_UP, undrag);
			main.removeChild(cursor[index].sprite);
			//	index = 1;
			main.addChild(cursor[index].sprite);
		}
		
		public function writeXML():void
		{
			generateXML();
		}
		
		public function setAdd(e:MouseEvent):void
		{
			isModify = false;
		}
		
		public function setModify(e:MouseEvent):void
		{
			isModify = true;
		}
		
		public function drag(e:MouseEvent):void
		{
			e.target.parent.startDrag();
		}
		
		public function undrag(e:MouseEvent):void
		{
			e.target.parent.stopDrag();
		}
		
		public function loadAreas():void
		{
			//	new pictureButton(main, 400, 150, "assets/WLBCurrent/4. map/Africa.png", 1, true, true);
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Africa.png", "Africa", 1, true, true));
			
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Alaska.png", "Alaska", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Australia.png", "Australia", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Canada.png", "Canada", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Central_America.png", "Central_America", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/East_Asia.png", "East_Asia", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/East_Europe.png", "East_Europe", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Ice_Greenland.png", "Ice_Greenland", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Middle_East.png", "Middle_East", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Pacific_Islands.png", "Pacific_Islands", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/Sout_Asia.png", "Sout_Asia", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/South_America.png", "South_America", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/US_North_East.png", "US_North_East", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/US_North_Midwest.png", "US_North_Midwest", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/US_South_East.png", "US_South_East", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/US_South_Midwest.png", "US_South_Midwest", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/US_South_West.png", "US_South_West", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/West_Asia.png", "West_Asia", 1, true, true));
			areas.push(new pictureButton1(main, 400, 150, "assets/Map/West_Europe.png", "West_Europe", 1, true, true));
		
		}
		
		public function generateXML():void
		{
			main.xmlString += "<map>";
			for (var j:int = 0; j < areas.length; j++)
			{
				for (var i:int = 0; i < cursorsAdded.length; i++)
				{
					if (areas[j].bmd.getPixel(cursorsAdded[i].sprite.x - 400 + 33, cursorsAdded[i].sprite.y - 150 + 49) != 0)
					{
						areas[j].count++;
					}
				}
				main.xmlString += "<" + areas[j].areaName + ">";
				main.xmlString += "" + areas[j].count;
				main.xmlString += "</" + areas[j].areaName + ">";
			}
			main.xmlString += "</map>";
		}
	
	}

}
package
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.geom.Rectangle;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import flash.external.*;
	
	public class CheckList
	{
		public var main:Main;
		public var form:pictureButton;
		public var cursor:pictureButton;
		public var instructions:label;
		public var checks:Array = new Array();
		public var changes:String;
		
		public function CheckList(p_main:Main)
		{
			main = p_main;
		}
		
		public function render():void
		{
			instructions = new label(main, 800, 300, "How would you arrange your work time?", 35, 400);
			cursor = new pictureButton(main, 0, 0, "assets/CheckList/pen.png", 0.1, true);
			Mouse.hide();
			new pictureButton(main, 400, -50, "assets/CheckList/clipboard.png");
			main.graphics.beginFill(0, 1);
			main.graphics.drawRect(550, 200, 50, 50);
			main.graphics.drawRect(550, 400, 50, 50);
			main.graphics.drawRect(550, 600, 50, 50);
			main.graphics.endFill();
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(555, 205, 40, 40);
			main.graphics.drawRect(555, 405, 40, 40);
			main.graphics.drawRect(555, 605, 40, 40);
			main.graphics.endFill();
			checks.push(new pictureCheckButton(main, this, 550, 200, 1));
			checks.push(new pictureCheckButton(main, this, 550, 400, 2));
			checks.push(new pictureCheckButton(main, this, 550, 600, 3));
			
			new label(main, 150, 200, "More time at work", 30, 400);
			new label(main, 150, 400, "More time at home", 30, 400);
			new label(main, 150, 600, "Wouldn’t change a thing", 30, 400);
			main.nextButton.addEventListener(MouseEvent.CLICK, click);
			main.nextButton.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.nextButton.addEventListener(MouseEvent.MOUSE_OUT, out);
			main.getTime();
			changes = "<check>";
		}
		
		public function recordChanges(ind:int):void
		{
			changes += "*" + ind + "@" + main.getTime();
			trace(changes);
		}
		
		public function update():void
		{
			
			if (main.mouseX < 150 || main.mouseX > 650 || main.mouseY < 20 || main.mouseY > 750)
			{
				move();
			}
			else
			{
				out();
			}
			if (main.contains(cursor.sprite))
			{
				main.setChildIndex(cursor.sprite, main.numChildren - 1);
				cursor.sprite.x = main.mouseX - 32 + 20;
				cursor.sprite.y = main.mouseY - 80;
			}
			for (var i:int = 0; i < checks.length; i++)
			{
				checks[i].update();
			}
		}
		
		public function keyPress():void
		{
		
		}
		
		public function click(e:Event):void
		{
			main.nextButton.addEventListener(MouseEvent.CLICK, click);
			main.nextButton.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.nextButton.addEventListener(MouseEvent.MOUSE_OUT, out);
			
			if (main.contains(cursor.sprite))
				main.removeChild(cursor.sprite);
			Mouse.show();
		}
		
		public function move(e:Event = null):void
		{
			if (main.contains(cursor.sprite))
				main.removeChild(cursor.sprite);
			Mouse.show();
		}
		
		public function out(e:Event = null):void
		{
			
			if (!main.contains(cursor.sprite))
				main.addChild(cursor.sprite);
			cursor.sprite.x = main.mouseX - 32 + 20;
			cursor.sprite.y = main.mouseY - 80;
			Mouse.hide();
		}
		
		public function writeXML():void
		{
			main.changesString += changes + "</check>";
			main.changesString += "</changes>";			
			main.xmlString += "<check>";
			main.xmlString += "<value>" + checks[0].isSelected + "</value>";
			main.xmlString += "<value>" + checks[1].isSelected + "</value>";
			main.xmlString += "<value>" + checks[2].isSelected + "</value>";
			main.xmlString += "</check>";
			main.xmlString += main.changesString;			
			main.xmlString += "</WLB>";
			trace(main.xmlString);
			var xmlData:XML = new XML(main.xmlString);
			trace(xmlData);
			main.postData();
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	
	}
}
package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	
	public class Pencil extends MovieClip
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var isDragging:Boolean;
		private var pencil:Loader;
		public var sprite:Sprite;
		private var index:int;
		private var label:Label;
		private var string:String;
		private var centerX:Number;
		private var centerY:Number;
		private var destinationX:Number;
		private var destinationY:Number;
		private var description:String;
		public var selected:Boolean;
		
		public function Pencil(m:Main, x:Number, y:Number, s:String, d:String, ind:int)
		{
			main = m;
			positionX = x;
			positionY = y;
			string = s;
			description = d;
			index = ind;
			
			sprite = new Sprite();
			pencil = new Loader();
			pencil.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			pencil.load(new URLRequest(main.prefix + "assets/pencil.png"));
			sprite.addEventListener(MouseEvent.MOUSE_DOWN, onMouseClick);
			sprite.addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);			
			sprite.addEventListener(MouseEvent.MOUSE_OVER, move);
			
			isDragging = false;
			selected = false;
		}
		
		private function onLoaderReady(e:Event):void
		{
			
			sprite.addChild(pencil);
			sprite.setChildIndex(pencil, 0);
			main.addChild(sprite);
			
			sprite.x = positionX - pencil.width * sprite.scaleX / 2;
			sprite.y = positionY - pencil.height * sprite.scaleY / 2;
			
			centerX = sprite.x + pencil.width * sprite.scaleX / 2;
			centerY = sprite.y + pencil.height * sprite.scaleY / 2;
			destinationX = positionX - pencil.width * sprite.scaleX / 2;
			destinationY = positionY - pencil.height * sprite.scaleY / 2;
			
			label = new Label(main, pencil.x + 15, pencil.y + 3, string, 14, 350, 0xFFFFFF);
			label.addToPencil(this);
			label.addShadow();
		}
		
		public function update():void
		{
			if (main.numChildren > 2 && main.contains(sprite) && !selected)
			{
				if (!isDragging)
				{
					main.setChildIndex(sprite, main.numChildren - 2);					
				}
				else
				{
					main.setChildIndex(sprite, main.numChildren - 1);
				}
			}
			
			if (!isDragging)
			{
				sprite.x = (sprite.x + destinationX) / 2;
				sprite.y = (sprite.y + destinationY) / 2;
			}
			else
			{
				//trace("X: " + sprite.x +" Y: " + sprite.y);
				if (main.contains(pencil))
				{
					//	main.setChildIndex(pencil,main.numChildren-1);
				}
				
				if (mouseX < 0 || mouseX > 1600 || mouseY < 0 || mouseY > 800)
				{
					onMouseUp();
				}
			}
			
			if (selected)
			{
				sprite.x = (sprite.x + destinationX) / 2;
				sprite.y = (sprite.y + destinationY) / 2;
			}
		}
		
		public function onMouseClick(e:MouseEvent):void
		{
			sprite.scaleY = 1;
			sprite.rotationZ = 90;
			isDragging = true;
			sprite.startDrag();
			sprite.x = mouseX + pencil.height / 2;
			sprite.y = mouseY - pencil.height / 2;
			if (selected)
			{
				if (mouseX > 250 && mouseX < 450 && mouseY > 0 && mouseY < 435)
				{
					main.taken[0] = false;
					main.addChild(sprite);
					selected = false;
					main.choices[0] = null;
					main.penHolderValues[0] = 0;
					recordChange();
				}
				if (mouseX > 550 && mouseX < 750 && mouseY > 0 && mouseY < 385)
				{
					main.taken[1] = false;
					main.addChild(sprite);
					selected = false;
					main.choices[1] = null;
					main.penHolderValues[1] = 0;
					recordChange();
				}
				if (mouseX > 850 && mouseX < 1050 && mouseY > 0 && mouseY < 385)
				{
					main.taken[2] = false;
					main.addChild(sprite);
					selected = false;
					main.choices[2] = null;
					main.penHolderValues[2] = 0;
					recordChange();
				}
				if (mouseX > 1150 && mouseX < 1350 && mouseY > 0 && mouseY < 435)
				{
					main.taken[3] = false;
					main.addChild(sprite);
					selected = false;
					main.choices[3] = null;
					main.penHolderValues[3] = 0;
					recordChange();
				}
			}
			main.timeDiff = getTimer() - main.elapsedTime;
			main.elapsedTime = getTimer();
			main.changeString += "*" + index + "@" + main.timeDiff;
		}
		
		public function onMouseOut(e:Event):void
		{
			sprite.scaleY = 1;
		}
		
		public function move(e:Event = null):void
		{
			sprite.parent.setChildIndex(sprite, sprite.parent.numChildren - 1);
			if (!isDragging)
			{
				sprite.scaleY = 1.35;
			}
		}
		
		public function onMouseUp(e:Event = null):void
		{
			sprite.rotationZ = 0;
			isDragging = false;
			sprite.stopDrag();
			
			centerX = mouseX;
			centerY = mouseY;
			destinationX = positionX - pencil.width * sprite.scaleX / 2;
			destinationY = positionY - pencil.height * sprite.scaleY / 2;
			if (!main.taken[0] && mouseX > 250 && mouseX < 450 && mouseY > 0 && mouseY < 435) //top
			{
				//trace("over holder 1");
				sprite.rotationZ = 75;
				main.taken[0] = true;
				destinationX = 50;
				destinationY = -125;
				main.holders[0].putInHolder(this);
				selected = true;
				main.choices[0] = description;
				main.penHolderValues[0] = index;
				recordChange();
			}
			if (!main.taken[1] && mouseX > 550 && centerX < 750 && mouseY > 0 && mouseY < 385) //top
			{
				//trace("over holder 2");
				main.taken[1] = true;
				sprite.rotationZ = 75;
				destinationX = 50;
				destinationY = -175;
				main.holders[1].putInHolder(this);
				selected = true;
				main.choices[1] = description;
				main.penHolderValues[1] = index;
				recordChange();
			}
			if (!main.taken[2] && mouseX > 850 && mouseX < 1050 && mouseY > 0 && mouseY < 385) //top
			{
				//trace("over holder 3");
				main.taken[2] = true;
				sprite.rotationZ = 75;
				destinationX = 50;
				destinationY = -175;
				main.holders[2].putInHolder(this);
				selected = true;
				main.choices[2] = description;
				main.penHolderValues[2] = index;
				recordChange();
			}
			if (!main.taken[3] && mouseX > 1150 && mouseX < 1350 && mouseY > 0 && mouseY < 435) //top
			{
				//trace("over holder 4");
				main.taken[3] = true;
				sprite.rotationZ = 75;
				destinationX = 50;
				destinationY = -125;
				main.holders[3].putInHolder(this);
				selected = true;
				main.choices[3] = description;
				main.penHolderValues[3] = index;
				recordChange();
			}
		}
		
		private function recordChange():void
		{
			main.changeString += "#";
			for (var i:int; i < 4; i++)
			{
				main.changeString += main.penHolderValues[i] + "-";
			}
			
			main.changeString = main.changeString.substring(0, main.changeString.length - 1);
			main.timeDiff = getTimer() - main.elapsedTime;
			main.elapsedTime = getTimer();
			main.changeString += "@" + main.timeDiff;
			trace(main.changeString);
		}
	}

}
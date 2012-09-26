package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class ScrollBar 
	{
		
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		public var length:Number;
		
		public var dataLength:Number;
		public var totalDataLength:Number;
		
		public var bar:Picture;
		public var barMask:Picture;
		public var isDragging:Boolean = false;
		
		public var buttonLength:Number=57;
		
		public var value:Number = 0;
		
		public var list:List;
		
		private var upButton:Picture;
		private var downButton:Picture;
		
		public function ScrollBar(p_main:Main,p_list:List,px:Number,py:Number,p_length:Number) 
		{
			main = p_main;
			list = p_list;
			positionX = px;
			positionY = py;
			length = p_length;
			
			drawBar();
			main.stage.addEventListener(Event.ENTER_FRAME, update);
		}
		
		public function drawBar():void
		{
			upButton=new Picture(main, positionX, positionY - 8, "assets/buttonUp.png", 17);
			var blank:Picture = new Picture(main, positionX - 17 / 2, positionY, "assets/blank.png", 108, false);
			blank.sprite.scaleY = length / 108;
			downButton=new Picture(main, positionX, positionY +length + 8, "assets/buttonDown.png", 17);
			
			bar= new Picture(main, positionX - 17 / 2, positionY, "assets/bar.png", 57, false);
			barMask = new Picture(main, positionX - 17 / 2, positionY, "assets/barMask.png", 57, false);
			main.stage.addEventListener(MouseEvent.MOUSE_DOWN,down);
			main.stage.addEventListener(MouseEvent.MOUSE_UP,up);
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE,move);
		//	bar.sprite.scaleY = dataLength/totalDataLength/length*57;
		//	barMask.sprite.scaleY = length / 57 / totalDataLength * dataLength;
		
			upButton.sprite.addEventListener(MouseEvent.MOUSE_DOWN, moveUp);
			downButton.sprite.addEventListener(MouseEvent.MOUSE_DOWN, moveDown);
		}
		
		public function update(e:Event=null):void
		{
			buttonLength = length * list.screenHeight / list.currHeight  ;
			if (buttonLength < length)
			{
			bar.sprite.scaleY = 1 / 57 * buttonLength;
			barMask.sprite.scaleY = 1 / 57 * buttonLength;
			}
			else
			{
			bar.sprite.scaleY = 1 / 57 * 1;
			barMask.sprite.scaleY = 1 / 57 * 1;
			}
			if (main.contains(bar.sprite))
			{
				main.setChildIndex(bar.sprite,main.numChildren-1);
			}
			if (main.contains(barMask.sprite))
			{
				main.setChildIndex(barMask.sprite,main.numChildren-1);
			}
			
			if (main.contains(upButton.sprite))
			{
				main.setChildIndex(upButton.sprite,main.numChildren-1);
			}
			if (main.contains(downButton.sprite))
			{
				main.setChildIndex(downButton.sprite,main.numChildren-1);
			}
			
			if (isDragging)
			{
				bar.sprite.y = barMask.sprite.y;
			}
			else
			{
				barMask.myLoader.x = bar.sprite.x;
				barMask.sprite.y = bar.sprite.y;
			}
			if (bar.sprite.y < positionY)
			{
				bar.sprite.y = positionY;
			}
			if (bar.sprite.y > positionY + length - buttonLength)
			{
				bar.sprite.y = positionY + length - buttonLength;
			}
			value = bar.sprite.y - positionY;
			value = value / (length - buttonLength);
		}
		
		public function down(e:Event=null):void
		{
			if (main.mouseX > positionX - 8 && main.mouseX < positionX + 8 && main.mouseY > positionY && main.mouseY < positionY + length)
			{
				barMask.setPosition(main.mouseX,main.mouseY);
				isDragging = true;
				barMask.sprite.startDrag();
			
			}
			if (main.mouseX > positionX - 8 && main.mouseX < positionX + 8 && main.mouseY < positionY && main.mouseY > positionY - 17)
			{
				moveUp();
			}
			if (main.mouseX > positionX - 8 && main.mouseX < positionX + 8 && main.mouseY < positionY+length && main.mouseY > positionY+length - 17)
			{
				moveDown();
			}
		}
		
		public function up(e:Event=null):void
		{
			isDragging = false;
			barMask.sprite.stopDrag();
		}
		
		public function moveUp(e:Event=null):void
		{
			bar.sprite.y = bar.sprite.y -10;
		}
		
		public function moveDown(e:Event=null):void
		{
			bar.sprite.y = bar.sprite.y + 10;
		}
		
		
		public function move(e:Event=null):void
		{
			if (main.mouseX > positionX - 8 && main.mouseX < positionX + 8 && main.mouseY > positionY-16 && main.mouseY < positionY + length+16)
			{
				bar.sprite.alpha = 1;
				upButton.sprite.alpha = 1;
				downButton.sprite.alpha = 1;
			}
			else
			{
				bar.sprite.alpha = 0.7;
				upButton.sprite.alpha = 0.7;
				downButton.sprite.alpha = 0.7;
			}
		}
		
	}

}
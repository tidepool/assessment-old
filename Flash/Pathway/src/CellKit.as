package
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	import flash.utils.getTimer;
	
	public class CellKit
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		
		public var cell:Picture;
		public var pic:Picture;
		
		public var backGround:Picture;
		public var cellBG:Picture;
		
		public var mask:Picture;
		
		public var label:Label;
		
		public var layerFlag:Boolean = true;
		public var isDragging:Boolean = false;
		
		public var p:Rectangle = null;
		public var pictureString:String;
		public var isMouseIn:Boolean = false;
		private var index:int;
		
		private var textString:String;
		private var descString:String;
		private var messageBox:MessageBox;
		
		public function CellKit(p_main:Main, p_x:Number, p_y:Number, p_s:String, ts:String, ds:String, i:int = -1)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			pictureString = p_s;
			index = i;
			textString = ts;
			descString = ds;
			
			cellBG = new Picture(main, positionX, positionY, "assets/step.png", 125);
			backGround = new Picture(main, positionX, positionY, "assets/" + p_s, 75);
			
			cell = new Picture(main, positionX, positionY, "assets/step.png", 125);
			pic = new Picture(main, positionX, positionY, "assets/" + p_s, 75);
			
			mask = new Picture(main, positionX, positionY, "assets/circleMask.png", 125);
			
			label = new Label(main, positionX, positionY + 60, textString, 20, 170);
			
			messageBox = new MessageBox(main, positionX - 100, positionY + 100, 200, descString,18);
			messageBox.hide();
			
			mask.sprite.addEventListener(MouseEvent.MOUSE_DOWN, mouseDown);
			mask.sprite.addEventListener(MouseEvent.MOUSE_UP, mouseUp);
			
			cellBG.sprite.alpha = 0.5;
			backGround.sprite.alpha = 0.5;
			
			mask.sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			mask.sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		public function update():void
		{
			if (layerFlag)
			{
				if (main.contains(cell.sprite) && main.contains(pic.sprite) && main.contains(mask.sprite) && main.contains(cellBG.sprite) && main.contains(backGround.sprite))
				{
					main.setChildIndex(cellBG.sprite, main.numChildren - 1);
					main.setChildIndex(backGround.sprite, main.numChildren - 1);
					main.setChildIndex(cell.sprite, main.numChildren - 1);
					main.setChildIndex(pic.sprite, main.numChildren - 1);
					main.setChildIndex(mask.sprite, main.numChildren - 1);
					layerFlag = false;
				}
			}
			
			p = checkDes();
			
			if (isDragging)
			{
				pic.setLength(50);
				main.setChildIndex(cell.sprite, main.numChildren - 1);
				main.setChildIndex(pic.sprite, main.numChildren - 1);
				main.setChildIndex(mask.sprite, main.numChildren - 1);
				if (p == null)
				{
					cell.setPosition(mask.positionX, mask.positionY);
					pic.setPosition(mask.positionX, mask.positionY);
				}
				else
				{
					cell.setPosition(p.x, p.y);
					pic.setPosition(p.x, p.y);
				}
			}
		}
		
		public function mouseDown(e:Event):void
		{
			mask.sprite.startDrag();
			isDragging = true;
			main.recordClick(index+"/-1");
		}
		
		public function mouseUp(e:Event):void
		{
			mask.sprite.stopDrag();
			isDragging = false;
			
			cell.setPosition(backGround.positionX, backGround.positionY);
			pic.setPosition(backGround.positionX, backGround.positionY);
			mask.setPosition(backGround.positionX, backGround.positionY);
			if (p != null)
			{
				main.selected.push(new SetStone(main, p.x, p.y, pictureString,p,index));
				main.points.splice(main.points.indexOf(p), 1);
				main.trackChange(index+"/"+p.width);
			}
		}
		
		public function move(e:Event):void
		{
			isMouseIn = true;
			pic.setLength(150);
			label.hide();
			messageBox.show();
		}
		
		public function out(e:Event):void
		{
			isMouseIn = false;
			pic.setLength(75);
			messageBox.hide();
			label.show();
		}
		
		public function checkDes():Rectangle
		{
			for (var i:int = 0; i < main.points.length; i++)
			{
				if (mask.positionX < main.points[i].x + 50 && mask.positionX > main.points[i].x - 50 && mask.positionY < main.points[i].y + 50 && mask.positionY > main.points[i].y - 50)
				{
					return main.points[i];
				}
			}
			return null;
		}
	
	}

}
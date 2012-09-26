package
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	
	public class SetStone
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var cell:Picture;
		private var pic:Picture;
		private var mask:Picture;
		private var layerFlag:Boolean = true;
		private var isDragging:Boolean = false;
		private var p:Rectangle = null;		
		private var oldPoint:Rectangle = null;
		private var pictureString:String;
		private var index:int;
		
		public function SetStone(p_main:Main, p_x:Number, p_y:Number, p_s:String, oldp:Rectangle, ind:int = -1)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			pictureString = p_s;
			oldPoint = oldp;
			index = ind;
			
			main.rockValues[oldPoint.width - 1] = index;
			cell = new Picture(main, positionX, positionY, "assets/step.png", 125);
			pic = new Picture(main, positionX, positionY, "assets/" + pictureString, 75);
			mask = new Picture(main, positionX, positionY, "assets/circleMask.png", 125);
			
			mask.sprite.addEventListener(MouseEvent.MOUSE_DOWN, mouseDown);
			mask.sprite.addEventListener(MouseEvent.MOUSE_UP, mouseUp);		
		}
		
		public function update():void
		{
			if (main.contains(cell.sprite) && main.contains(pic.sprite) && main.contains(mask.sprite))
			{
				main.setChildIndex(cell.sprite, main.numChildren - 1);
				main.setChildIndex(pic.sprite, main.numChildren - 1);
				main.setChildIndex(mask.sprite, main.numChildren - 1);
			}
			
			p = checkDes();
			
			if (isDragging)
			{
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
			main.recordClick(index+"/"+oldPoint.width);
		}
		
		public function mouseUp(e:Event):void
		{
			
			mask.sprite.stopDrag();
			isDragging = false;
			
			if (p != null)
			{
				main.selected.push(new SetStone(main, p.x, p.y, pictureString,p,index));
				main.points.splice(main.points.indexOf(p), 1);
				main.points.push(oldPoint);
				main.trackChange(index+"/"+p.width);
				remove();
			}
			else
			{
				if ((mask.positionX < positionX - 50) || (mask.positionX > positionX + 50) || (mask.positionY < positionY - 50) || (mask.positionY > positionY + 50))
				{
					main.points.push(oldPoint);
					main.trackChange(index+"/-2");
					remove();
				}
			}
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
		
		public function remove():void
		{
			cell.remove();
			pic.remove();
			mask.remove();
			main.selected.splice(main.selected.indexOf(this), 1);
		}
	}

}
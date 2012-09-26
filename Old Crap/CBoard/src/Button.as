package  
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class Button 
	{
		public var main:Object;
		public var positionX:Number;
		public var positionY:Number;
		
		public var sprite:Sprite = new Sprite();
		
		public var label:Label;
		
		private var button1:Picture;
		private var button2:Picture;
		
		private var isOver:Boolean = false;
		
		public function Button(p_main:Object,px:Number,py:Number,text:String) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			label = new Label(sprite, positionX, positionY, text,20,140,true);
		//	sprite.addEventListener(MouseEvent.CLICK, click);
			
			button1 = new Picture(sprite,positionX,positionY,"assets/button1.png",100);
			button2 = new Picture(sprite,positionX,positionY,"assets/button2.png",100);
		
			main.addChild(sprite);
			sprite.addEventListener(Event.ENTER_FRAME, update);
			sprite.addEventListener(MouseEvent.MOUSE_OVER, over);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		public function over(e:Event=null):void
		{
			isOver = true;
			label.text.textColor = 0xffffff;
		}
		
		public function out(e:Event=null):void
		{
			isOver = false;
			label.text.textColor = 0;
		}
		
		public function update(e:Event=null):void
		{
			if (isOver)
			{
				if (sprite.contains(button1.sprite))
				{
					sprite.setChildIndex(button1.sprite,sprite.numChildren-1);
				}
			}
			else
			{
				if (sprite.contains(button2.sprite))
				{
					sprite.setChildIndex(button2.sprite,sprite.numChildren-1);
				}
			}
			if (sprite.contains(label.sprite))
			{
				sprite.setChildIndex(label.sprite,sprite.numChildren-1);
			}
		}
		
		public function click(e:Event=null):void
		{
			main.hideCompany();
		}
		
	}

}
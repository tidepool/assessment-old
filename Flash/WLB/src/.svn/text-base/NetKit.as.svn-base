package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;

	public class NetKit 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		
		public var mask:pictureButton;
		public var black:pictureButton;
		public var color:pictureButton;
		
		public var isMouseOver:Boolean = false;
		
		
		public var screen:Net;
		public var text:String;
		public var l:label;
		
		public function NetKit(p_main:Main,p_screen:Net,px:Number,py:Number,url:String,scale:Number,offset:Boolean=false,p_text:String="") 
		{
			positionX = px;
			positionY = py;
			text = p_text;
			main = p_main;
			screen = p_screen;
			mask=new pictureButton(main, px, py, "assets/Nets/mask.png", scale);
			black = new pictureButton(main, px, py, "assets/Nets/black-net.jpg", scale);
			if (offset)
			{
				color = new pictureButton(main, px+3, py+2, url, scale);
			}
			else
			{
				color = new pictureButton(main, px, py, url, scale);
			}
			main.addEventListener(Event.ENTER_FRAME, update);
			mask.sprite.addEventListener(MouseEvent.MOUSE_OVER, mouseOver);
			mask.sprite.addEventListener(MouseEvent.MOUSE_OUT, mouseOut);
			mask.sprite.addEventListener(MouseEvent.CLICK, click);
			l=new label(main,positionX-150,750,text,25, 300);
			
			
			l.sprite.addEventListener(MouseEvent.MOUSE_OVER, mouseOver);
			l.sprite.addEventListener(MouseEvent.MOUSE_OUT, mouseOut);
			l.sprite.addEventListener(MouseEvent.CLICK, click);
		}
		
		public function update(e:Event=null):void
		{
			if (isMouseOver)
			{
				setColorAbove();
				l.text.textColor = 0x0000ff;
			}
			else
			{
				setBlackAbove();
				l.text.textColor = 0;
			}
		}
		
		public function click(e:Event=null):void
		{
			screen.destination = this;
			screen.setStatusSlected();
		}
		
		public function mouseOver(e:Event=null):void
		{
			if (screen.isSelected)
			{
				return;
			}
			isMouseOver = true;
		}
		
		public function mouseOut(e:Event=null):void
		{
			if (screen.isSelected)
			{
				return;
			}
			isMouseOver = false;
		}
		
		
		public function setColorAbove():void
		{
			if (main.contains(black.sprite))
			{
				main.setChildIndex(black.sprite,main.numChildren-1);
			}
			if (main.contains(color.sprite))
			{
				main.setChildIndex(color.sprite,main.numChildren-1);
			}
			if (main.contains(mask.sprite))
			{
				main.setChildIndex(mask.sprite,main.numChildren-1);
			}
			if (screen.butterFly != null)
			{
				if (main.contains(screen.butterFly.sprite))
				{
					main.setChildIndex(screen.butterFly.sprite,main.numChildren-1);
				}
			}
		}
		
		public function setBlackAbove():void
		{
			if (main.contains(color.sprite))
			{
				main.setChildIndex(color.sprite,main.numChildren-1);
			}
			if (main.contains(black.sprite))
			{
				main.setChildIndex(black.sprite,main.numChildren-1);
			}
			if (main.contains(mask.sprite))
			{
				main.setChildIndex(mask.sprite,main.numChildren-1);
			}
			if (screen.butterFly != null)
			{
				if (main.contains(screen.butterFly.sprite))
				{
					main.setChildIndex(screen.butterFly.sprite,main.numChildren-1);
				}
			}
		}
		
	}

}
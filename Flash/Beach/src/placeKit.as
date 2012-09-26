package  
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	public class placeKit 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var pic:picture;
		public var text:Label;
		public var textString:String;
		public var isSelected:Boolean;
		
		public function placeKit(p_main:Main,px:Number,py:Number,picURL:String,p_textString:String) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			pic = new picture(main, positionX, positionY, picURL, 400);
			text = new Label(main, 0, 0, "");
			textString = p_textString;
			pic.sprite.addEventListener(MouseEvent.MOUSE_MOVE, showText);
			pic.sprite.addEventListener(MouseEvent.MOUSE_OUT, hideText);
			pic.sprite.addEventListener(MouseEvent.MOUSE_MOVE, showSelection);
			pic.sprite.addEventListener(MouseEvent.MOUSE_OUT, hideSelection);
			pic.sprite.addEventListener(MouseEvent.CLICK, click);
			isSelected = false;
		}
		
		
		public function showSelection(e:Event=null):void
		{
			var sprite:Sprite = pic.sprite;
			var myLoader:Loader = pic.myLoader;
			main.graphics.beginFill(0x0000FF, 0.7);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width*sprite.scaleX+20, myLoader.height*sprite.scaleY+20);
			main.graphics.endFill();
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 5, sprite.y - 5, myLoader.width*sprite.scaleX+10, myLoader.height*sprite.scaleY+10);
			main.graphics.endFill();
		}
		
		public function hideSelection(e:Event=null):void
		{
			var sprite:Sprite = pic.sprite;
			var myLoader:Loader = pic.myLoader;
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width*sprite.scaleX+20, myLoader.height*sprite.scaleY+20);
			main.graphics.endFill();
			isSelected = false;
		}
		
		public function showText(e:Event=null):void
		{
			text.changeText(positionX,positionY+200,25,textString);
		}
		
		public function hideText(e:Event=null):void
		{
			text.changeText(positionX,positionY+200,25,"");
		}	
		
		public function click(e:Event=null):void
		{
			isSelected = true;
			main.displayNext();
		}
	}

}
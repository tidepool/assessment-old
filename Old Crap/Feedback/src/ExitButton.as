package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFormat;
	/**
	 * ...
	 * @author wei
	 */
	public class ExitButton extends MovieClip 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var sprite:Sprite = new Sprite();
		
		public var text:TextField=new TextField();
		
		public function ExitButton(p_main:Main,p_x:Number,p_y:Number,p_s:String)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			
			text.addEventListener(MouseEvent.MOUSE_MOVE, mouseOn);
			text.addEventListener(MouseEvent.MOUSE_OUT, mouseOut);
			text.addEventListener(MouseEvent.CLICK, click);
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=50;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
			show();
		}
		
		public function mouseOn(e:Event):void
		{
			text.textColor = 464;
		}
		
		public function mouseOut(e:Event):void
		{
			text.textColor = 0;
		}
		
		public function click(e:Event):void
		{
				if (main.parent.parent != null )
				{
					main.parent.parent.removeChild(main.parent);
				}
			
		}
		
		public function show():void
		{
			main.addChild(sprite);
		}
		
		public function hide():void
		{
			main.removeChild(sprite);
		}
		
		public function changeText(s:String):void
		{
			text.text = s;
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size=50;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
		}
	}

}
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
	
	public class textButton extends MovieClip 
	{
		public var main:Main;
		
		
		public var positionX:Number;
		public var positionY:Number;
		
		
		public var sprite:Sprite = new Sprite();
		
		public var next:int;
		public var myLoader:Loader = new Loader();
		
		public var text:TextField=new TextField();

		
		public function textButton(p_main:Main,p_x:Number,p_y:Number,p_s:String)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			text.multiline = true;
			text.wordWrap = true;
			text.width = 300;
			text.text = p_s;
			sprite.addChild(text);
			sprite.x = positionX;
			sprite.y = positionY;
			main.addChild(sprite);
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.addEventListener(MouseEvent.CLICK, click);
			var fileRequest:URLRequest = new URLRequest("assets/projective/mask.png");
			myLoader.load(fileRequest);

			
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="old-school DOS";
			format1.size=30;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize = TextFieldAutoSize.CENTER;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);

			text.textColor = 0;
		//	sprite.addEventListener(MouseEvent.CLICK, click);
			
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			// the image is now loaded, so let's add it to the display tree!     
			sprite.addChild(myLoader);
			sprite.x = positionX;
			sprite.y = positionY;
		} 
		
		public function click(e:Event):void
		{
			if (main.parent.parent != null)
			{
				main.parent.parent.removeChild(main.parent);
			}
		}
		
	}

}
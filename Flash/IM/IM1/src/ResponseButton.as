package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.text.*;
	
	public class ResponseButton extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var string:String = new String;		
		private var message:TextField;
		private var format1:TextFormat;
		private var sprite:Sprite;
		private var index:int;
		
		public function ResponseButton(p_main:Main, p_x:Number, p_y:Number, s:String, i:int) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			string = s;
			sprite = new Sprite();		
			sprite.addEventListener(MouseEvent.CLICK, sendMessage);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(main.prefix + "assets/button.png"));	
			
			format1 = new TextFormat();
			format1.font="Arial";
			format1.bold = true;
			format1.size = 22;
			format1.align = TextFormatAlign.CENTER;

			message = new TextField();
			message.text = string;
			message.x = positionX;
			message.y = 2 + positionY;
			message.multiline = true;
			message.wordWrap = true;
			message.width = 190;
			message.selectable = false;	
			message.textColor = 0xFFFFFF;
            message.antiAliasType=AntiAliasType.ADVANCED;
			message.gridFitType = GridFitType.SUBPIXEL;		
            message.setTextFormat(format1);			
			
			index = i;
		}
		
		public function onLoaderReady(e:Event) :void
		{
			sprite.addChild(myLoader);
			myLoader.x = positionX;
			myLoader.y = positionY;
			sprite.addChild(message);
			main.addChild(sprite);
		} 
		
		public function sendMessage(e:Event):void
		{
			if (!main.responseGiven)
			{
				main.replyMessage = new ReplyMessage(main, 0, 100, message.text);
				main.newMessage();
				main.responseGiven = true;
				main.xmlString = "" + index;
				trace("sent: " + message.text);
			}
		}
		
	}

}
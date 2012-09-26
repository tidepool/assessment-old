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
	/**
	 * ...
	 * @author wei
	 */
	public class ReplyMessage extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var string:String = new String;	
		private var message:TextField;
		private var format1:TextFormat;
		private var header1:TextField;
		private var header2:TextField;
		
		public function ReplyMessage(p_main:Main,p_x:Number,p_y:Number,s:String) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			string = s;
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoader.load(new URLRequest(main.prefix + "assets/replyMessage.png"));
			
			
			format1 = new TextFormat();
			format1.font="Arial";
			format1.bold = true;
			format1.size = 22;
			format1.align = TextFormatAlign.CENTER;
			
			
			

			header1 = new TextField();
			header1.text = "INSTANT MESSAGE";
			header1.x = 485;
			header1.y = 290;
			header1.width = 250;
			header1.selectable = false;	
			header1.textColor = 0x000000;
            header1.antiAliasType=AntiAliasType.ADVANCED;
			header1.gridFitType=GridFitType.SUBPIXEL;
            header1.setTextFormat(format1);
			
			header2 = new TextField();
			header2.text = "From: USER";
			header2.x = 750;
			header2.y = 290;
			header2.width = 200;
			header2.selectable = false;	
			header2.textColor = 0xFF0000;
            header2.antiAliasType=AntiAliasType.ADVANCED;
			header2.gridFitType=GridFitType.SUBPIXEL;
            header2.setTextFormat(format1);
			
			
			message = new TextField();
			message.text = string;
			message.x = 630;
			message.y = 400;
			message.multiline = true;
			message.wordWrap = true;
			message.width = 400;
			message.selectable = false;	
			message.textColor = 0xFFFFFF;
            message.antiAliasType=AntiAliasType.ADVANCED;
			message.gridFitType = GridFitType.SUBPIXEL;		
			format1.align = TextFormatAlign.LEFT;
            message.setTextFormat(format1);
			
		}
		
		public function onLoaderReady(e:Event) :void
		{
			main.addChild(myLoader);
			main.setChildIndex(myLoader, 1);
			main.addChild(header1);
			main.setChildIndex(header1, 2);
			main.addChild(header2);
			main.setChildIndex(header2, 2);
			main.addChild(message);
			main.setChildIndex(message, 2);
		} 
		
		public function update():void
		{
			message.x = 595 + positionX;
			message.y = 400 + positionY;
			myLoader.x = positionX;
			myLoader.y = positionY - 5-30;
			
			
			header2.x = 950 + positionX;
			header2.y = 370 + positionY;
			header1.x = 580 + positionX;
			header1.y = 370 + positionY;
		}
		
	}

}
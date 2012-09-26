package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	
	public class pictureChoice extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var string:String = new String();
		public var length:Number;
		public var maskLoader:Loader = new Loader();
		public var masksprite:Sprite = new Sprite();
		public var chart:PieChart;
		
		public var dx:Number;
		public var dy:Number;
		
		public var l:label;
		public var t:String;
		
		public var selected:Boolean = false;
		
		public var scn:Trash;
		
		
		public function pictureChoice(p_main:Main,p_sc:Trash,p_x:Number,p_y:Number,s:String,p_label:String,p_length:Number,p_chart:PieChart=null) 
		{
			main = p_main;
			scn = p_sc;
			chart = p_chart;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			length = p_length;
			l = new label(main, 0, 0, "");
			l.changeWidth(400);
			t = p_label;
			sprite.addEventListener(MouseEvent.MOUSE_OVER, highlightText);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
			l.sprite.addEventListener(MouseEvent.MOUSE_OVER, highlightText);
			l.sprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
		}
		
		public function onLoaderReady(e:Event) :void
		{
			sprite.addChild(myLoader);
			
			main.addChild(sprite);
			masksprite.addChild(maskLoader);
			main.addChild(masksprite);
			
			
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			myLoader.scaleX = 1 / a * length;
			myLoader.scaleY = 1 / a * length;
			var scale:Number = 1 / a * length;
			sprite.x = positionX - myLoader.width / 2 * sprite.scaleX;
			sprite.y = positionY - myLoader.height / 2 * sprite.scaleX;
			if (chart != null)
			{
				chart.redraw();
			}
			dx = sprite.x;
			dy = sprite.y;
			
			sprite.addEventListener(MouseEvent.CLICK, click);
			l.sprite.addEventListener(MouseEvent.CLICK, click);
			var temp:Number = positionY + (myLoader.height*myLoader.scaleY/2 )+100;
			trace(temp);
			l.changeText(positionX-200,temp,18,t,400);
		} 
		
		public function update():void
		{
			var a:Number = myLoader.width;
			if (myLoader.height > a)
			{
				a = myLoader.height;
			}
			
			sprite.x = (sprite.x + dx) / 2;
			sprite.y = (sprite.y + dy) / 2;
			if (sprite.alpha < 0.2)
			{
				if (main.contains(sprite))
				{
					main.removeChild(sprite);
					l.changeText(0,0,1,"");
				}
			}
		}
		
		public function showSelection():void
		{
			main.graphics.beginFill(0x0000FF, 0.7);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width * sprite.scaleX + 20, myLoader.height * sprite.scaleY + 20);
			main.graphics.endFill();
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 5, sprite.y - 5, myLoader.width * sprite.scaleX + 10, myLoader.height * sprite.scaleY + 10);
			main.graphics.endFill();
		}
		
		public function loadNew(s:String):void
		{
			sprite.removeChild(myLoader);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + s);
			myLoader.load(fileRequest);
			string = s;
			length = 400;
			
		}		
		
		public function hideSelection():void
		{
			main.graphics.clear();
		}
		
		public function highlightText(e:Event=null):void
		{
			l.text.textColor = 0x8746FF;
			showSelection();
		}
		
		public function lowlightText(e:Event=null):void
		{
			l.text.textColor = 0;
			hideSelection();
		}
	
		
		public function calculateDes():void
		{
			if (scn == null)
			{
				dx = 700 - myLoader.width / 2 * sprite.scaleX;
				dy = 600 - myLoader.height / 2 * sprite.scaleY;
			}
			else
			{
				dx = 1200 - myLoader.width / 2 * sprite.scaleX;
				dy = 600 - myLoader.height / 2 * sprite.scaleY;
			}
		}
		
		public function click(e:Event):void
		{
			selected = true;
			scn.writeXML();
			if (scn == null)
			{
			
			calculateDes();
			}
			else
			{
			selected = true;
			scn.click();
			}
		}
	}

}
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
	
	public class PenHolder extends MovieClip 
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var backplate:Loader;
		private var frontplate:Loader;
		private var sprite:Sprite
		private var type:int;
		private var pen:Pencil;
		private var hasAdded:Boolean = false;
		public function PenHolder(m:Main,x:Number,y:Number,t:int=1) 
		{
			main = m;
			positionX = x;
			positionY = y;
			type = t;
			
			sprite = new Sprite();
			backplate = new Loader();
			frontplate = new Loader();
			backplate.load(new URLRequest(main.prefix + "assets/backplate.png"));
			frontplate.load(new URLRequest(main.prefix + "assets/frontplate"+type+".png"));
			frontplate.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			backplate.addEventListener(MouseEvent.MOUSE_OVER, move);
			frontplate.addEventListener(MouseEvent.MOUSE_OVER, move);
			backplate.addEventListener(MouseEvent.MOUSE_OUT, out);
			frontplate.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		private function onLoaderReady(e:Event) :void
		{        
			sprite.addChild(backplate);
			sprite.setChildIndex(backplate, 0);
			sprite.addChild(frontplate);
			sprite.setChildIndex(frontplate, 1);
			main.addChild(sprite);
			sprite.x = positionX - frontplate.width  * sprite.scaleX / 2;
			sprite.y = positionY - frontplate.height  * sprite.scaleY / 2;
			
			//trace("Holder" + type + "\t X: " + sprite.x + " Y: " + sprite.y + " width: " + frontplate.width + " height: " + frontplate.height); 
		} 		
		
		public function update():void
		{
			if (main.numChildren > 3 && main.contains(sprite))
			{
				main.setChildIndex(sprite, main.numChildren - 3);
			}
		}
		
		public function putInHolder(pencil:Pencil):void
		{
			pen = pencil;
			sprite.addChild(pencil.sprite);
			sprite.setChildIndex(backplate, 0);
			sprite.setChildIndex(pencil.sprite, 1);
			sprite.setChildIndex(frontplate, 2);
		//	pencil.sprite.addEventListener(MouseEvent.MOUSE_MOVE, move);
			pencil.sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
		}
		
		
		
		public function move(e:Event=null):void
		{
			if (pen == null)
			return;
			if (sprite.contains(pen.sprite))
			{
				sprite.setChildIndex(pen.sprite, sprite.numChildren-1);
				pen.sprite.scaleY = 1.35;
			}
			
		}
		
		public function out(e:Event=null):void
		{
			if (pen == null)
			return;
			if (sprite.contains(pen.sprite))
			{
				pen.sprite.scaleY = 1;
				sprite.setChildIndex(backplate, 0);
				sprite.setChildIndex(pen.sprite, 1);
				sprite.setChildIndex(frontplate, 2);
			}
		}
		
	}

}
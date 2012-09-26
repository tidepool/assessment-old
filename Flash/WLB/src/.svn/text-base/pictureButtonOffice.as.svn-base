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

	public class pictureButtonOffice extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		
		public var myLoader:Loader = new Loader();
		public var maskLoader:Loader = new Loader();
		
		public var sprite:Sprite = new Sprite();
		public var masksprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();
		
		public var string:String = new String();
		public var scale:Number;
		public var isSelected:Boolean;
		public var shouldAdd:Boolean;
		private var l:label;
		public var family:Object;
		public var url:String;
		public var urlSelected:String;
		
		public var isActive:Boolean = true;
		public var ID:int;
		
		
		public function pictureButtonOffice(p_main:Main,p_family:Object,p_x:Number,p_y:Number,num:String,s:String, id:int = -1,p_scale:Number=1, p_shouldAdd:Boolean=true) 
		{
			main = p_main;
			family = p_family;
			shouldAdd = p_shouldAdd;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			url = "assets/Office/" + num + ".jpg";
			urlSelected="assets/Office/" + num + ".png";
			scale = p_scale;
			myLoader.load(new URLRequest(main.prefix + "assets/Office/"+num+".jpg"));
			maskLoader.load(new URLRequest(main.prefix + "assets/Family/mask.png"));
			string = s;
			isSelected = false;
			l = new label (main, positionX - 40, sprite.y + 40, string, 20, 300);
			ID = id;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.addChild(myLoader);
			if (shouldAdd )
			{
				main.addChild(sprite);
				main.setChildIndex(sprite, 1);
			}
			if (isActive)
			{
				if (!main.contains(sprite))
				{
					main.addChild(sprite);
					main.setChildIndex(sprite, 1);
				}
			}
			else
			{
				if (main.contains(sprite))
				{
					main.removeChild(sprite);
				}
			}
			sprite.x = positionX-myLoader.width/2*sprite.scaleX;
			sprite.y = positionY;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
		//	myLoader.toString
			masksprite.addChild(maskLoader);
			
			sprite.addEventListener(MouseEvent.CLICK, click);
			sprite.addEventListener(MouseEvent.MOUSE_OVER, move);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			
			l.sprite.addEventListener(MouseEvent.CLICK, click);
			l.sprite.addEventListener(MouseEvent.MOUSE_OVER, move);
			l.sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			
			l.changeText(positionX+myLoader.width/2*sprite.scaleX-l.text.textWidth/2 - 40, sprite.y+myLoader.height*sprite.scaleY + 20,20, string);
			l.changeText(positionX-140 , sprite.y+myLoader.height*sprite.scaleY + 20,20, string);
			if (!isActive)
			{
				l.changeText(0, 0, 0, "");
			}
		} 
		
		public function click(e:Event):void
		{			
			family.decorate(urlSelected,ID);
		}
		
		public function move(e:Event=null):void
		{
			l.text.textColor = 0x0000FF;
			showSelection();
		}
		
		public function out(e:Event=null):void
		{
			l.text.textColor = 0;
			hideSelection();
		}
		
		public function showSelection():void
		{
			main.graphics.beginFill(0x0000FF, 0.7);
			main.graphics.drawRect(sprite.x - 10, sprite.y - 10, myLoader.width*sprite.scaleX+20, myLoader.height*sprite.scaleY+20);
			main.graphics.endFill();
			main.graphics.beginFill(0xFFFFFF, 1);
			main.graphics.drawRect(sprite.x - 5, sprite.y - 5, myLoader.width*sprite.scaleX+10, myLoader.height*sprite.scaleY+10);
			main.graphics.endFill();
		}
		
		public function hideSelection():void
		{
			main.graphics.clear();
			isSelected = false;
		}
		
		public function changePicture(num:String, s:String):void
		{
			url = "assets/Office/" + num + ".jpg";
			urlSelected="assets/Office/" + num + ".png";
			string = s;
			myLoader.load(new URLRequest(main.prefix + url));
		}		
	}

}
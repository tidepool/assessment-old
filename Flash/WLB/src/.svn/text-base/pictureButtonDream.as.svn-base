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
	
	public class pictureButtonDream extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		
		public var myLoader:Loader = new Loader();
		public var maskLoader:Loader = new Loader();
		public var l:label;
		
		public var sprite:Sprite = new Sprite();
		public var masksprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();
		
		public var string:String = new String();
		public var scale:Number;
		public var isSelected:Boolean;
		public var shouldAdd:Boolean;
		
		public var family:Dream;
		
		public function pictureButtonDream(p_main:Main,p_family:Dream,p_x:Number,p_y:Number,s:String,desc:String,p_scale:Number=1,p_shouldAdd:Boolean=true) 
		{
			main = p_main;
			family = p_family;
			shouldAdd = p_shouldAdd;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			scale = p_scale;
			myLoader.load(new URLRequest(main.prefix + "assets/Dream/"+s+".jpg"));
			maskLoader.load(new URLRequest(main.prefix + "assets/Dream/mask.png"));
			string = s;
			isSelected = false;
			string = desc;
			
			l = new label(main, positionX, positionY + 190, string, 18, 200);
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.addChild(myLoader);
			if (shouldAdd)
			{
				main.addChild(sprite);
			}
			sprite.x = positionX;
			sprite.y = positionY;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
			masksprite.addChild(maskLoader);
			
			sprite.addEventListener(MouseEvent.CLICK, showSelection);
			masksprite.addEventListener(MouseEvent.CLICK, hideSelection);
			
			sprite.addEventListener(MouseEvent.MOUSE_MOVE, highlightText);
			sprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
			
			masksprite.addEventListener(MouseEvent.MOUSE_MOVE, highlightText);
			masksprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
			
			
			l.sprite.addEventListener(MouseEvent.MOUSE_MOVE, highlightText);
			l.sprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
			l.sprite.addEventListener(MouseEvent.CLICK, textClick);
		} 
		
		public function showSelection(e:Event=null):void
		{
			
			isSelected = true;
			family.writeXML();
			main.displayNext();
			return;
			for (var i:int = 0; i < family.s.length; i++ )
			{
				family.s[i].hideSelection(null);
			}
			main.addChild(masksprite);
			masksprite.x = sprite.x+myLoader.width/2*sprite.scaleX-200+15;
			masksprite.y = sprite.y + myLoader.height / 2 * sprite.scaleY - 150;
			main.showNextButton();
		}
		
		public function hideSelection(e:Event=null):void
		{
			isSelected = false;
			if (main.contains(masksprite))
			{
				main.removeChild(masksprite);
			}
			masksprite.x = sprite.x;
			masksprite.y = sprite.y;
		}
		
		
		public function highlightText(e:Event=null):void
		{
			
			l.text.textColor = 0x8746FF;
		}
		
		public function lowlightText(e:Event=null):void
		{
			l.text.textColor = 0;
		}
	
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
		
		public function textClick(e:Event=null):void
		{
			if (isSelected)
			{
				hideSelection();
			}
			else
			{
				showSelection();
			}
		}
	}

}
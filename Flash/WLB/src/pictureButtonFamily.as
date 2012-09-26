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

	public class pictureButtonFamily extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;		
		public var myLoader:Loader = new Loader();
		public var maskLoader:Loader = new Loader();
		public var text:TextField = new TextField();		
		public var sprite:Sprite = new Sprite();
		public var masksprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();		
		public var string:String = new String();
		public var scale:Number;
		public var isSelected:Boolean;
		public var shouldAdd:Boolean;		
		public var family:Family;
		
		private var index:int;
		
		public function pictureButtonFamily(p_main:Main, p_family:Family, p_x:Number, p_y:Number, s:String, ind:int, p_scale:Number = 1, p_shouldAdd:Boolean = true) 
		{
			main = p_main;
			family = p_family;
			shouldAdd = p_shouldAdd;
			positionX = p_x;
			positionY = p_y;
			index = ind;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			scale = p_scale;
			myLoader.load(new URLRequest(main.prefix + "assets/Family/"+s+".png"));
			maskLoader.load(new URLRequest(main.prefix + "assets/Family/mask.png"));
			isSelected = false;
			string = s;
			
			var format1:TextFormat = new TextFormat();
			format1.align = TextFormatAlign.CENTER;			
			format1.font="Arial";
			format1.size = 16;
			format1.bold = true;
			
			text.text = string;
			text.multiline = true;
			text.wordWrap = true;
			text.width = 300;
			text.textColor = 0;
			textSprite.addChild(text);
			textSprite.x = positionX;
			textSprite.y = positionY;		
			text.selectable = false;
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.LEFT;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);
			text.width = 250;
			
			main.addChild(text);;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			sprite.addChild(myLoader);
			if (shouldAdd)
			{
				main.addChild(sprite);
			}
			
			sprite.x = positionX - myLoader.width * sprite.scaleX / 2;
			sprite.y = positionY;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
			masksprite.addChild(maskLoader);			
			text.y = positionY + 300;						
			text.x = positionX - (myLoader.width * sprite.scaleX / 2);
			
			sprite.addEventListener(MouseEvent.CLICK, showSelection);
			masksprite.addEventListener(MouseEvent.CLICK, showSelection);
			text.addEventListener(MouseEvent.CLICK, showSelection);
			
			sprite.addEventListener(MouseEvent.MOUSE_MOVE, highlightText);
			masksprite.addEventListener(MouseEvent.MOUSE_MOVE, highlightText);
			text.addEventListener(MouseEvent.MOUSE_MOVE, highlightText);
			
			sprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
			masksprite.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
			text.addEventListener(MouseEvent.MOUSE_OUT, lowlightText);
		} 
		
		public function showSelection(e:Event):void
		{
			//trace("Clicked");
			family.recordChanges(index);
			if (isSelected)
			{
				//trace("in null section");
				family.p.loadNew("assets/Family/Sad.png");
				main.hideNextButton();
				hideSelection(null);
			}
			else
			{
				isSelected = true;
				for (var i:int = 0; i < family.s.length; i++ )
				{
					if (family.s[i] != this)
					{
						family.s[i].hideSelection(null);
					}
				}
				main.addChild(masksprite);
				masksprite.x = sprite.x-60;
				masksprite.y = positionY + 290;
				main.showNextButton();
				family.p.loadNew("assets/Family/Happy.png");
			}
		}
		
		
		public function hideSelection(e:Event):void
		{
			isSelected = false;
			//trace("removed");
			if (main.contains(masksprite))
			{
				main.removeChild(masksprite);
			}
			masksprite.x = sprite.x;
			masksprite.y = sprite.y;
		}
		
		
		public function highlightText(e:Event=null):void
		{
			text.textColor = 0x8746FF;
		}
		
		public function lowlightText(e:Event=null):void
		{
			text.textColor = 0;
		}
	
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
	}

}
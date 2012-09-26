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
	
	public class DragablePic extends MovieClip 
	{
		public var main:Main;
		public var destinationX:Number;
		public var positionX:Number;
		public var positionY:Number;
		public var isDragging:Boolean;
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();
		public var textSprite:Sprite = new Sprite();
		public var maskLoader:Loader = new Loader();
		public var maskSprite:Sprite = new Sprite();
		public var index:int;
		public var from:pictureButtonInit;
		public var status:int;
		
		public var blueLoader:Loader = new Loader();
		public var purpleLoader:Loader = new Loader();
		public var redLoader:Loader = new Loader();
		
		public var picString:String;
		
		public var text:TextField = new TextField();
		
		public var nextTimer:int = 50;
		public var nextFlag:Boolean = false;
		public var picname:String;
		
		public function DragablePic(p_main:Main,p_x:Number,p_y:Number,s:String,picS:String,p_name:String="") 
		{
			main = p_main;
			picString = picS;
			positionX = p_x;
			positionY = p_y;
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			maskLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			
			myLoader.load(new URLRequest(main.prefix + picS));
			maskLoader.load(new URLRequest(main.prefix + "assets/Travel/mask.png"));
			blueLoader.load(new URLRequest(main.prefix + "assets/Nets/blue-butterfly.png"));
			redLoader.load(new URLRequest(main.prefix + "assets/Nets/orange-butterfly.png"));
			purpleLoader.load(new URLRequest(main.prefix + "assets/Nets/yellow-butterfly.png"));
			
			isDragging = false;
			sprite.x = positionX;
			destinationX = positionX;
			
			picname = p_name;
			text.text = s;
			text.text = picname;
			text.multiline = true;
			text.wordWrap = true;
			text.width = 300;
			text.textColor = 0x8746FF;
			textSprite.addChild(text);
			textSprite.x = positionX;
			textSprite.y = positionY+15;
			
			
			text.selectable = false;
			var format1:TextFormat = new TextFormat();
			format1.font="Arial";
			format1.size = 26;
			format1.align = "center";
            text.antiAliasType=AntiAliasType.ADVANCED;
            text.autoSize=TextFieldAutoSize.CENTER;
			text.gridFitType=GridFitType.SUBPIXEL;
            text.setTextFormat(format1);			
			status = 0;	
		}
		
		public function onLoaderReady(e:Event) :void
		{        
			sprite.addChild(myLoader);
			main.addChild(sprite);
			
			maskSprite.addChild(maskLoader);
			main.addChild(maskSprite);
			
			main.addChild(textSprite);
			destinationX = positionX;
			
			
			sprite.scaleX = 1;
			sprite.scaleY = 1;
			
			maskSprite.scaleX = 1 / maskLoader.width * myLoader.width * sprite.scaleX;
			maskSprite.scaleY = 1 / maskLoader.height * myLoader.height * sprite.scaleY;			

			sprite.x = positionX - myLoader.width * sprite.scaleX / 2;
			sprite.y = positionY;					
		} 
		
		
		public function onMouseClick(e:MouseEvent) :void
		{
			if (e.altKey != true)
			{
				main.setChildIndex(maskSprite,main.numChildren-1);
				main.setChildIndex(sprite,main.numChildren-2);
				isDragging = true;
				maskSprite.startDrag();
			}
			else
			{
				
			}
		}
		
		public function onMouseUp(e:Event) :void
		{
			isDragging = false;
			maskSprite.stopDrag();
			if (status != 0)
			{
				setDeactivated();
			}
		}
		
		public function setDeactivated():void
		{
			text.text = "";
			main.removeChild(sprite);
			main.removeChild(maskSprite);
			
			main.xmlString += "<choice>" +status + "</choice>" ;
			if (status == 1)
			{
				new pictureButton(main, 430, 400, "assets/Nets/blue-butterfly.png", 0.3);
				nextFlag = true;
			}
			else if (status == 2)
			{
				new pictureButton(main, 830, 410, "assets/Nets/orange-butterfly.png", 0.4);
				nextFlag = true;
			}
			else if (status == 3)
			{
				new pictureButton(main, 1230, 390, "assets/Nets/yellow-butterfly.png", 0.5);
				nextFlag = true;
			}
		}
		
		
		public function update():void
		{
			if (main.contains(textSprite))
			{
				main.setChildIndex(textSprite,main.numChildren-1);
			}
			if (main.contains(sprite))
			{
				main.setChildIndex(sprite,main.numChildren-1);
			}
			if (main.contains(maskSprite))
			{
				main.setChildIndex(maskSprite,main.numChildren-1);
			}
			if (nextFlag)
			{
				nextTimer--;
				if (nextTimer < 0)
				{
					main.displayNext();
				}
			}
			textSprite.x = sprite.x +myLoader.width/2*sprite.scaleX-text.width/2;
			textSprite.y = sprite.y+30 +myLoader.height*sprite.scaleY-text.textHeight/2;
		
		}
		
		public function checkStatus():void
		{
			var x:Number = sprite.x + myLoader.width / 2 * sprite.scaleX;
			var y:Number = sprite.y + myLoader.height / 2 * sprite.scaleY;
			if (sprite.y > 350 && sprite.y < 600)
			{
				if (sprite.x > 200 && sprite.x < 400)
				{
					status = 1;
					return;
				}
				if (sprite.x > 500 && sprite.x < 800)
				{
					status = 2;
					return;
				}
				if (sprite.x > 900 && sprite.x < 1200)
				{
					status = 3;
					return;
				}
			}
			
				status = 0;
		}
	}

}
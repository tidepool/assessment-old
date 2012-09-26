package
{
	import flash.accessibility.Accessibility;
	import flash.display.BitmapData;
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.geom.Rectangle;
	import flash.net.URLRequest;
	import flash.text.TextField;
	import flash.text.TextFormat;
	
	public class Cloud extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		
		private var originalX:Number;
		private var originalY:Number;
		private var myLoader:Loader = new Loader();
		private var description:String = new String();
		private var isSelected:Boolean;
		private var label:Label;
		private var index:int;
		private var type:String;
		private var loaded:Boolean;
		private var cloud:Loader;
		private var background:Sprite = new Sprite();
		private var pictureNumber:String;
		private var color:uint;
		private var shown:Boolean;
		private var onScreen:Boolean;
		private var completionTicks:Number;
		
		public function Cloud(p_main:Main, p_x:Number, p_y:Number, picString:String, ii:int)
		{
			index = ii;
			main = p_main;
			
			originalX = p_x;
			originalY = p_y;
			positionX = originalX;
			positionY = originalY;
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			
			loaded = false;
			var temp:int = picString.search("_");
			description = picString.substring(0, temp);
			var tempString:String = picString.substring(temp + 1, picString.length);
			pictureNumber = tempString;
			myLoader.load(new URLRequest(main.prefix + "assets/Numbers/" + tempString + ".jpg"));
			
			isSelected = false;
			
			if (!main.preLoaded)
				main.loadList.push(background);
			else
				main.addChild(background);
			
			cloud = new Loader();
			cloud.load(new URLRequest(main.prefix + "assets/cloud.png"));
			cloud.contentLoaderInfo.addEventListener(Event.COMPLETE, onCloudReady);
			
			label = new Label(main, positionX, positionY);
			label.addBold();
			background.addChild(label);
			myLoader.alpha = 1;
			color = 0x000000;
			shown = false;
			onScreen = false;
			
			cloud.addEventListener(MouseEvent.MOUSE_OVER, onMouseOver);
			background.addEventListener(MouseEvent.MOUSE_OVER, onMouseOver);
			label.sprite.addEventListener(MouseEvent.MOUSE_OVER, onMouseOver);
			
			cloud.addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);
			background.addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);
			label.sprite.addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);
			
			cloud.addEventListener(MouseEvent.CLICK, onMouseClick);
			background.addEventListener(MouseEvent.CLICK, onMouseClick);
			label.sprite.addEventListener(MouseEvent.CLICK, onMouseClick);
		}
		
		private function onCloudReady(e:Event):void
		{
			cloud.y = positionY;
			cloud.alpha = 0.8;
			if (!main.preLoaded)
				main.loadList.push(cloud);
			else
				main.addChild(cloud);
		}
		
		private function onMouseClick(e:Event = null):void
		{
			main.xmlString += "<pic>" + pictureNumber + "</pic>";
			clear();
		}
		
		public function update(i:Number):void
		{
			if (positionX > -100 && !onScreen)
			{
				displayText();
				onScreen = true;
			}
			positionX += i;
			label.text.x = positionX - (label.text.width / 2);
			myLoader.x = positionX - (myLoader.width / 2) - 7;
			cloud.x = positionX - (cloud.width / 2);
			
			background.graphics.clear();
			if (loaded)
			{
				background.graphics.beginFill(color);
				background.graphics.drawRect(myLoader.x - 2, myLoader.y - 2, myLoader.width + 4, myLoader.height + 4);
				background.graphics.endFill();
			}
			
			if (main.contains(cloud) && main.contains(label.sprite) && main.contains(background))
			{
				main.setChildIndex(cloud, main.numChildren - 2);
				main.setChildIndex(background, main.numChildren - 1);
				main.setChildIndex(label.sprite, main.numChildren - 1);
			}
		}
		
		public function changePicture(picString:String):void
		{
			loaded = false;
			var temp:int = picString.search("_");
			description = picString.substring(0, temp);
			var tempString:String = picString.substring(temp + 1, picString.length);
			pictureNumber = tempString;
			myLoader.load(new URLRequest(main.prefix + "assets/Numbers/" + tempString + ".jpg"));
			positionX = originalX;
			positionY = originalY;
		}
		
		public function populate():void
		{
			background.addChild(myLoader);
			main.addChild(cloud);
			main.setChildIndex(cloud, 0);
			background.graphics.clear();
			main.addChild(background);
			main.addChild(label.text);
		}
		
		public function clear():void
		{
			main.removeChild(cloud);
			label.text.text = "";
			background.removeChild(myLoader);
			background.graphics.clear();
			isSelected = false;
			myLoader.alpha = 1;
			loaded = false;
		}
		
		private function displayText():void
		{
			label.changeText(positionX, positionY + 120, description, 16, 300);
		}
		
		private function onLoaderReady(e:Event):void
		{
			background.addChild(myLoader);
			background.setChildIndex(myLoader, 0);
			myLoader.x = positionX;
			myLoader.y = positionY;
			myLoader.scaleX = 1;
			myLoader.scaleY = 1;
			var a:Number = myLoader.width * 0.77;
			;
			if (myLoader.height > a)
			{
				a = myLoader.height;
				myLoader.scaleX = 150 / a;
				myLoader.scaleY = 150 / a;
			}
			else
			{
				a = myLoader.width;
				myLoader.scaleX = 160 / a;
				myLoader.scaleY = 160 / a;
				
			}
			myLoader.x = positionX - (myLoader.width * myLoader.scaleX / 2) - 25;
			myLoader.y = positionY + 25 - myLoader.height * myLoader.scaleY / 2;
			myLoader.alpha = 1;
			displayText();
			myLoader.alpha = 0.75;
			loaded = true;
		}
		
		private function onMouseOver(e:Event):void
		{
			cloud.alpha = 1;
			myLoader.alpha = 0.75;
			color = 0x0000FF;
			label.text.textColor = color;
		}
		
		private function onMouseOut(e:Event):void
		{
			cloud.alpha = 0.8;
			myLoader.alpha = 1;
			color = 0x000000;
			label.text.textColor = color;
		}
		
		public function nowShown():void
		{
			if (!shown)
			{
				main.progressCounter++;
				shown = true;
			}
			shown = true;
		}
		
		private function remove():void
		{
			main.removeChild(myLoader);
			main.removeChild(label.text);
		}
		
		private function hideSelection():void
		{
			background.graphics.clear();
			isSelected = false;
		}
	}

}
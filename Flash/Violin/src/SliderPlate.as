package  
{
	import adobe.utils.CustomActions;
	import flash.display.Loader;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.events.*;
	
	public class SliderPlate 
	{
		public var main:Main;
		public var pic:Picture;
		public var text:Label;
		public var slider:Slider;
		public var string:String;
		public var index:int;
		public var value:Number;
		public var shuttle:PictureShuttle;		
		public var backPlate:Loader;
		public var shouldRemove:Boolean;
		public var finished:Boolean;
		
		public function SliderPlate(p_main:Main,p_x:Number,p_y:Number,pic_s:String,text_s:String,p_length:Number,ind:int) 
		{
			
			main = p_main;
			string = text_s;
			index = ind;
			
			backPlate = new Loader();
			backPlate.load(new URLRequest(main.prefix + "assets/backPlate.png"));
			main.addChild(backPlate);
			main.setChildIndex(backPlate, 0);
			
			
			pic = new Picture(main, p_x, p_y , pic_s,p_length);
			text = new Label(main, 400, p_y+260 , text_s,30);
			slider = new Slider(main, p_x - p_length / 3 , p_y + 305, p_length/1.5 , "Low", "High");			
			slider.reset();
			shouldRemove = false;
			finished = false;
		}
		
		public function update():void
		{
			slider.update();
			value = slider.value;
			if (shuttle != null)
			{
				shuttle.update();
			}
			if (shuttle != null)
			{
				if (shuttle.removeMe )
				{
						main.removeChild(shuttle.sprite);
						shuttle.removeMe=false;
				}
			}
		}
		
		public function sendShuttle():void
		{
			shuttle = new PictureShuttle(main, 0, 0);
			shuttle.setActive(pic.sprite.x, pic.sprite.y, index * 200+50, 400 - pic.myLoader.height  * pic.sprite.scaleY / 2,"assets/"+ index + ".jpg", "", pic.sprite.scaleX);
			shouldRemove = true;
		}
		
		public function hide():void
		{
			main.removeChild(pic.sprite);
			main.removeChild(text.sprite);
			main.removeChild(slider.sprite);
			main.removeChild(slider.textLeft);
			main.removeChild(slider.textRight);
			main.removeChild(backPlate);
			main.removeChild(slider.barSprite);
			
			main.stage.removeEventListener(MouseEvent.CLICK, slider.clickOnBar);
			main.stage.removeEventListener(MouseEvent.MOUSE_MOVE, slider.move);
			main.stage.removeEventListener(MouseEvent.MOUSE_UP, slider.move);
		}
		
	}

}
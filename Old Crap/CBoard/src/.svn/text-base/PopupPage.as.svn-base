package  
{
	import flash.display.Sprite;
	/**
	 * ...
	 * @author Wei
	 */
	public class PopupPage 
	{
		
		public var main:Object;
		
		public var page:ComparePage;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var picture:Picture;
		public var bg:Picture;
		public var label:Label;
		
		public var sprite:Sprite = new Sprite();
		
		public function PopupPage(p_main:Object,p_page:ComparePage) 
		{
			main = p_main;
			page = p_page;
			picture = new Picture(sprite, positionX - 100, positionY - 100, "assets/tidepool.png", 100);
			
			bg = new Picture(sprite, positionX - 100, positionY - 100, "assets/bg.png", 200,false);
			
			label = new Label(sprite,1,1,"",20,140,false);
		}
		
		public function show(px:Number,py:Number,url:String,text:String):void
		{
			positionX = px;
			positionY = py;
			picture.loadNew(url, 50);
			picture.setPosition(positionX, positionY);
			bg.setPosition(positionX-30,positionY);
			label.changeText(positionX+30,positionY,15,text,60);
			if (!page.sprite.contains(sprite))
			{
				page.sprite.addChild(sprite);
			}
			if (sprite.contains(bg.sprite))
			{
				sprite.setChildIndex(bg.sprite,0);
			}
		}
		
		public function hide():void
		{
			if (page.sprite.contains(sprite))
			{
				page.sprite.removeChild(sprite);
			}
		}
		
	}

}
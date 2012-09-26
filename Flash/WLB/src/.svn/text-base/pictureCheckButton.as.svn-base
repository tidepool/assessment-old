package  
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;

	public class pictureCheckButton extends MovieClip 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;		
		public var myLoader:Loader = new Loader();
		public var sprite:Sprite = new Sprite();		
		public var checkLoader:Loader = new Loader();
		public var checksprite:Sprite = new Sprite();		
		public var string:String = new String();
		public var scale:Number;
		public var isSelected:Boolean;
		public var shouldAdd:Boolean;
		
		private var checkList:CheckList;
		private var index:int;
		
		public function pictureCheckButton(p_main:Main, cl:CheckList, p_x:Number, p_y:Number, ind:int) 
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			checkList = cl;
			index = ind;
			
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			var fileRequest:URLRequest = new URLRequest(main.prefix + "assets/CheckList/checkMask.png");
			myLoader.load(fileRequest);
			
			fileRequest = new URLRequest(main.prefix + "assets/CheckList/check.png");
			checkLoader.load(fileRequest);
			isSelected = false;
			scale = 0.25;
		}
		
		public function onLoaderReady(e:Event) :void
		{     
			checksprite.addChild(checkLoader);
			sprite.addChild(myLoader);
			main.addChild(sprite);
			sprite.x = positionX;
			sprite.y = positionY;
			sprite.scaleX = scale;
			sprite.scaleY = scale;
			
			sprite.addEventListener(MouseEvent.CLICK, click);
		//	check();
		} 
		
		public function click(e:Event):void
		{
			if (isSelected)
			{
				isSelected = false;
				uncheck();
			}
			else
			{
				isSelected = true;
				check();
			}
			checkList.recordChanges(index);
		}
		
		public function update():void
		{
			if(main.contains(sprite))
			main.setChildIndex(sprite,main.numChildren-1);
		}
		
		
		public function remove():void
		{
			main.removeChild(sprite);
		}
		
		public function check():void
		{
			main.addChild(checksprite);
			main.setChildIndex(sprite,1);
			checksprite.x = sprite.x;
			checksprite.y = sprite.y;
			
			checksprite.scaleX = scale;
			checksprite.scaleY = scale;
			if(main.contains(sprite))
			main.setChildIndex(sprite,main.numChildren-1);
			
		}
		
		public function uncheck():void
		{
			if(main.contains(checksprite))
			main.removeChild(checksprite);
			
		}
	}

}
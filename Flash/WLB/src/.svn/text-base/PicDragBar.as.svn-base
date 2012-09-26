package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;

	public class PicDragBar extends Sprite 
	{
		public var picture:pictureButtonInit;
		public var shuttle:pictureShuttle;
		public var pictureDrags:Array;
		public var isMouseDown:Boolean;
		public var sortCoolDown:int;
		
		public var shuttleX:Number;
		public var shuttleY:Number;
		public var shuttleDesX:Number;
		public var shuttleDesY:Number;
		public var main:Main;
		
		public var count:int;
		
		public function PicDragBar(p_main:Main):void 
		{
			main = p_main;
			shuttle = new pictureShuttle(main,this,0,0);
			
			pictureDrags = new Array();
			
			new pictureButtonInit(main,this, 300+200*0, 500, "",main.strings[0]);
			new pictureButtonInit(main,this, 300+ 200*1, 500, "",main.strings[1]);
			new pictureButtonInit(main,this, 300+ 200*2, 500, "",main.strings[2]);
			new pictureButtonInit(main,this, 300+ 200*3, 500, "",main.strings[3]);
			new pictureButtonInit(main, this,300+ 200*4, 500, "",main.strings[4]);
			
			sortCoolDown = -1;
			shuttleDesX = 300;
			shuttleDesY = 200;
			
			count = 0;
			
		}
		
		public function update():void
		{
			shuttle.update();
			for (var i:int = 0; i < pictureDrags.length; i++ )
			{
				pictureDrags[i].update();
			}
			if (sortCoolDown < 0)
			{
				sortCoolDown = 5;
				sort();
			}
			sortCoolDown--;

		}
		
		
		public function sort():void
		{
			
			pictureDrags.sortOn("positionX",Array.NUMERIC);
			for (var i:int = 0; i < pictureDrags.length; i++ )
			{
				pictureDrags[i].destinationX = (i) *200+300;
			}
			
		}
		
		
		public function sendShuttle(p_X:Number,p_Y:Number,s:String,picS:String,isBack:Boolean=false,from:pictureButtonInit=null):void
		{
			if (isBack)
			{
				shuttleX = p_X;
				shuttleY = p_Y;
				shuttle.from = from;
			
				shuttle.setActive(shuttleX, shuttleY, from.sprite.x, from.sprite.y, s,picS);
			//	shuttle.setActive(from.sprite.x,from.sprite.y,700,700,s);
				shuttleDesX -= 200;
				shuttleDesY = 200;
				shuttle.isBack = true;
			}
			else
			{
				shuttleX = p_X;
				shuttleY = p_Y;
			
				shuttle.setActive(shuttleX,shuttleY,shuttleDesX,shuttleDesY,s,picS);
				shuttleDesX += 200;
				shuttleDesY = 200;
				shuttle.isBack = false;
			}
		}
		

		
		public function addPictureDrag(p_X:Number,p_Y:Number,s:String,picS:String):void
		{
			count++;
			pictureDrags.push(new pictureDrag(main, p_X, p_Y, s,picS));
		}
	}
	
}
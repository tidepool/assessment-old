package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.utils.getTimer;
	
	public class PicDragBar extends Sprite 
	{
		public var picture:PictureButtonInit;
		public var shuttle:PictureShuttle;
		public var pictureDrags:Array;
		public var isMouseDown:Boolean;
		public var sortCoolDown:int;		
		public var shuttleX:Number;
		public var shuttleY:Number;
		public var shuttleDesX:Number;
		public var shuttleDesY:Number;
		public var main:Main;		
		public var count:int;
		public var changes:String;
		public var changed:Boolean = false;;
		
		private var oldOrder:Array;
		
		public function PicDragBar(p_main:Main):void 
		{
			main = p_main;
			shuttle = new PictureShuttle(main,this,0,0);
			
			pictureDrags = new Array();
			
			pictureDrags.push(new PictureDrag(main, this, 300 + 200 * 0, 600, "",main.strings[0],1));
			pictureDrags.push(new PictureDrag(main, this, 300 + 200 * 1, 600, "",main.strings[1],2));
			pictureDrags.push(new PictureDrag(main, this, 300 + 200 * 2, 600, "",main.strings[2],3));
			pictureDrags.push(new PictureDrag(main, this, 300 + 200 * 3, 600, "",main.strings[3],4));
			pictureDrags.push(new PictureDrag(main, this, 300 + 200 * 4, 600, "",main.strings[4],5));
		
			sortCoolDown = -1;
			shuttleDesX = 300;
			shuttleDesY = 200;
			
			count = 0;
			changes = "";					
			main.elapsedTime = getTimer();
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
		
		public function setInitial():void
		{
			oldOrder = new Array();
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				oldOrder[i] = pictureDrags[i].index;
				changes += pictureDrags[i].index + "-";
			}
			changes = changes.substring(0, changes.length - 1);
			main.elapsedTime = getTimer();
		}
		
		public function trackChange(index:int):void
		{
			main.timeDiff = getTimer() - main.elapsedTime;	
			changes += "*" + index + "#";
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				changes += pictureDrags[i].index + "-";
			}
			changes = changes.substring(0, changes.length - 1);
			changes += "@" + main.timeDiff;
			main.elapsedTime = getTimer();
			changed = true;
			trace(changes);
		}
		
		public function trackTime(index:int):void
		{
			main.timeDiff = getTimer() - main.elapsedTime;			
			changes += "*" + index+"@"+main.timeDiff;
			main.elapsedTime = getTimer();
			trace(changes);
		}
		
		public function setOrder():void
		{
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				oldOrder[i] = pictureDrags[i].index;
			}
		}
		
		public function compareOrder():Boolean
		{
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				if (oldOrder[i] != pictureDrags[i].index)
				{
					return false;
				}
				
			}
			return true;
		}
		
		public function sort():void
		{
			
			pictureDrags.sortOn("positionX",Array.NUMERIC);
			for (var i:int = 0; i < pictureDrags.length; i++ )
			{
				pictureDrags[i].destinationX = (i) *200+300;
			}
			
		}
		
		
		public function sendShuttle(p_X:Number,p_Y:Number,s:String,picS:String,isBack:Boolean=false,from:PictureButtonInit=null):void
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
			pictureDrags.push(new PictureDrag(main, this, p_X, p_Y, s,picS,0));
		}
	}
	
}
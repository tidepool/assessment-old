package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.utils.getTimer;
	
	public class DragBar extends Sprite
	{
		public var main:Main;
		public var pictureDrags:Array;
		public var isRemoved:Boolean;
		public var oldOrder:Array;
		private var coolDownTimer:Number;
		public var changed:Boolean = false;
		
		public function DragBar(p_main:Main)
		{
			main = p_main;
			pictureDrags = new Array();
			isRemoved = false;
			coolDownTimer = 0;
		}
		
		public function setInitial():void
		{
			oldOrder = new Array();
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				oldOrder[i] = pictureDrags[i].type;
				main.changeString += pictureDrags[i].index + "-";
			}
			main.changeString = main.changeString.substring(0, main.changeString.length - 1);
			main.elapsedTime = getTimer();
		}
		
		public function trackChange():void
		{
			main.timeDiff = getTimer() - main.elapsedTime;
			main.changeString += "*";
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				main.changeString += pictureDrags[i].index + "-";
			}
			main.changeString = main.changeString.substring(0, main.changeString.length - 1);
			main.changeString += "@" + main.timeDiff;
			main.elapsedTime = getTimer();
			changed = true;
			trace(main.changeString);
		}
		
		public function trackClick(index:int):void
		{
			main.timeDiff = getTimer() - main.elapsedTime;
			main.changeString += "*" + index + "@" + main.timeDiff;
			main.elapsedTime = getTimer();
			changed = true;
			trace(main.changeString);
		}
		
		public function setOrder():void
		{
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				oldOrder[i] = pictureDrags[i].type;
			}
		}
		
		public function compareOrder():Boolean
		{
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				if (oldOrder[i] != pictureDrags[i].type)
				{
					return false;
				}
				
			}
			return true;
		}
		
		public function update():void
		{
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				pictureDrags[i].update();
			}
			if (getTimer() - coolDownTimer > 50)
			{
				coolDownTimer = getTimer();
				sort();
			}
		}
		
		public function sort():void
		{
			
			pictureDrags.sortOn("positionX", Array.NUMERIC);
			for (var i:int = 0; i < pictureDrags.length; i++)
			{
				pictureDrags[i].destinationX = (i) * 200 + 50;
			}
		
		}
		
		public function addPictureDrag(p_X:Number, p_Y:Number, p_pic:String, p_mask:String, s:String, ind:int):void
		{
			pictureDrags.push(new DragPicture(main, this, p_X, p_Y, p_pic, ind));
		}
		
		public function remove():void
		{
			if (!isRemoved)
			{
				isRemoved = true;
				for (var i:int = 0; i < pictureDrags.length; i++)
				{
					main.removeChild(pictureDrags[i].sprite);
					main.removeChild(pictureDrags[i].maskSprite);
					main.removeChild(pictureDrags[i].textSprite);
				}
			}
		}
	}

}
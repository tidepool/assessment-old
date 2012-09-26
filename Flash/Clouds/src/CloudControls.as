package
{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLRequest;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	
	public class CloudControls extends MovieClip
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var speed1:SpeedButton;
		public var speed2:SpeedButton;
		public var changes:String;
		
		private var speedLabel:Label;
		
		public function CloudControls(p_main:Main, x:int, y:int)
		{
			main = p_main;
			positionX = x;
			positionY = y;
			
			speedLabel = new Label(main, positionX - 200, positionY - 25, "Change Cloud Speed", 25, 400);
			speed1 = new SpeedButton(main, this, positionX, positionY + 50);
			changes = "";
			main.changeTime = getTimer();
		}
		
		public function setCorrect():void
		{
			//speed1.setCorrect();
			//speed2.setCorrect();
		}
		
		public function recordChanges(ind:int):void
		{
			var temp:Number = getTimer() - main.changeTime;
			main.changeTime = getTimer();
			changes += "*" + ind + "@" + temp;
			trace(changes);
		}
	}
}
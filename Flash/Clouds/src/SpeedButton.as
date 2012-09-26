package
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.*;
	import flash.net.URLRequest;
	
	public class SpeedButton extends Sprite
	{
		private var main:Main;
		private var positionX:Number;
		private var positionY:Number;
		private var myLoaderSlower:Loader = new Loader();
		private var myLoaderOverSlower:Loader = new Loader();
		private var myLoaderFaster:Loader = new Loader();
		private var myLoaderOverFaster:Loader = new Loader();
		private var controls:CloudControls;
		private var loadCount:int = 0;
		
		public function SpeedButton(p_main:Main, c:CloudControls, p_x:Number, p_y:Number)
		{
			main = p_main;
			positionX = p_x;
			positionY = p_y;
			controls = c;
			
			myLoaderOverSlower = new Loader();
			myLoaderOverSlower.load(new URLRequest(main.prefix + "assets/slowerOver.png"));
			myLoaderOverSlower.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoaderOverSlower.addEventListener(MouseEvent.CLICK, clickSlower);
			myLoaderOverSlower.addEventListener(MouseEvent.MOUSE_OUT, outSlower);
			main.loadList.push(myLoaderOverSlower);
			
			myLoaderSlower.load(new URLRequest(main.prefix + "assets/slower.png"));
			myLoaderSlower.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoaderSlower.addEventListener(MouseEvent.MOUSE_OVER, overSlower);
			
			myLoaderOverFaster = new Loader();
			myLoaderOverFaster.load(new URLRequest(main.prefix + "assets/fasterOver.png"));
			myLoaderOverFaster.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoaderOverFaster.addEventListener(MouseEvent.CLICK, clickFaster);
			myLoaderOverFaster.addEventListener(MouseEvent.MOUSE_OUT, outFaster);
			main.loadList.push(myLoaderOverFaster);
			//main.addChild(myLoaderOver);						
			
			myLoaderFaster.load(new URLRequest(main.prefix + "assets/faster.png"));
			myLoaderFaster.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderReady);
			myLoaderFaster.addEventListener(MouseEvent.MOUSE_OVER, overFaster);
		}
		
		private function onLoaderReady(e:Event):void
		{
			if (loadCount < 3)
			{
				loadCount++;
				return;
			}
			
			myLoaderOverSlower.x = positionX - myLoaderOverSlower.width / 2;
			myLoaderOverSlower.y = positionY - myLoaderOverSlower.height / 2;
			
			myLoaderOverFaster.x = positionX - myLoaderOverFaster.width / 2;
			myLoaderOverFaster.y = positionY - myLoaderOverFaster.height / 2;
			
			if (!main.preLoaded)
			{
				main.loadList.push(myLoaderSlower);
				main.loadList.push(myLoaderFaster);
			}
			else
			{
				main.addChild(myLoaderSlower);
				main.addChild(myLoaderFaster);
			}
			myLoaderSlower.x = positionX - myLoaderSlower.width / 2;
			myLoaderSlower.y = positionY - myLoaderSlower.height / 2;
			
			myLoaderFaster.x = positionX - myLoaderFaster.width / 2;
			myLoaderFaster.y = positionY - myLoaderFaster.height / 2;		
		}
		
		private function clickSlower(e:Event = null):void
		{
			main.velocity = 2;
			controls.recordChanges(2);
			if (main.contains(myLoaderFaster))
			{
				main.setChildIndex(myLoaderFaster, main.numChildren - 1);
			}
		}
		
		private function outSlower(e:Event):void
		{
			if (main.contains(myLoaderSlower))
			{
				main.setChildIndex(myLoaderSlower, main.numChildren - 1);
			}
		}
		
		private function overSlower(e:Event):void
		{
			if (main.contains(myLoaderOverSlower))
			{
				main.setChildIndex(myLoaderOverSlower, main.numChildren - 1);
			}
		}
		
		private function clickFaster(e:Event = null):void
		{
			main.velocity = 4;
			controls.recordChanges(4);
			if (main.contains(myLoaderSlower))
			{
				main.setChildIndex(myLoaderSlower, main.numChildren - 1);
			}
		}
		
		private function outFaster(e:Event):void
		{
			if (main.contains(myLoaderFaster))
			{
				main.setChildIndex(myLoaderFaster, main.numChildren - 1);
			}
		}
		
		private function overFaster(e:Event):void
		{
			if (main.contains(myLoaderOverFaster))
			{
				main.setChildIndex(myLoaderOverFaster, main.numChildren - 1);
			}
		}
	
	}

}
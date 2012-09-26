package  
{
	import flash.display.Loader;
	import flash.events.Event;
	import flash.net.*;
	
	public class Preloader 
	{
		public var main:Main;
		public var myLoader:Loader = new Loader();
		public var index:int = 0;
		public var url:Array = new Array();
		public var label:Label;
		
		public function Preloader(p_main:Main) 
		{
			main = p_main;
			
			var myTextLoader:URLLoader = new URLLoader();
			label = new Label(main, 0, 0,"");

			myTextLoader.addEventListener(Event.COMPLETE, onLoaded);

			//trace("before load");
			myTextLoader.load(new URLRequest("../FileLists/PenHoldersList.txt"));
			//trace("after load");
		}
	
		private function onLoaded(e:Event):void 
		{
			var myArrayOfLines:Array = e.target.data.split(/@/);
			
			for (var i = 0; i < myArrayOfLines.length; i++)
			{
				trace(myArrayOfLines[i]);
				addURL(myArrayOfLines[i]);
			}
			
			load();
			trace("end onLoaded");
		}
		
		
		private function addURL(s:String):void
		{
			url.push(s);
		}
		
		private function load():void
		{
			new PreloadingImage(main,800,320);
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, loadNext);
			label.changeText(300, 300, 35, (int)((index / url.length) * 100) + "%",1000);
			var fileRequest:URLRequest = new URLRequest(url[index]);			
			myLoader.load(fileRequest);
		}
		
		private function loadNext(e:Event=null):void
		{
			index++;
			label.changeText(300, 300, 35, (int)((index / url.length) * 100) + "%",1000);
			if (index >= url.length)
			{
				main.makeCall();
			}
			else
			{
				var fileRequest:URLRequest = new URLRequest(url[index]);
				myLoader.load(fileRequest);
			}
			
		}
	}

}
package
{
	import flash.display.Loader;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	
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
			label = new Label(main, 0, 0, "");
			
			//trace("before load");
			
			if (ExternalInterface.available)
			{
				ExternalInterface.addCallback("recieveList", processList);
				ExternalInterface.call("getList", " ");
			}
			
			//trace("after load");
			//processList("Clouds");
		}
		
		public function processList(list:String):void
		{
			var myTextLoader:URLLoader = new URLLoader();
			myTextLoader.addEventListener(Event.COMPLETE, onLoaded);
			//label.changeText(300, 500, 35, list, 1000);
			myTextLoader.load(new URLRequest("../FileLists/" + list + "List.txt"));		
		}
		
		private function onLoaded(e:Event):void
		{
			var myArrayOfLines:Array = e.target.data.split(/@/);
			
			for (var i:int = 0; i < myArrayOfLines.length; i++)
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
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, loadNext);
			label.changeText(300, 200, 18, (int)((index / url.length) * 100) + "% Loaded", 1000);
			var fileRequest:URLRequest = new URLRequest(url[index]);
			myLoader.load(fileRequest);
		}
		
		private function loadNext(e:Event = null):void
		{
			index++;
			label.changeText(300, 200, 18, (int)((index / url.length) * 100) + "% Loaded", 1000);
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
package
{
	import flash.display.Loader;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	
	public class Preloader
	{
		private var main:Main;
		private var myLoader:Loader = new Loader();
		private var loaderList:Array = new Array();
		private var index:int = 0;
		private var listIndex:int = 0;
		private var url:Array = new Array();
		//private var label:Label;
		//private var listLabel:Label;
		private var myTextLoader:URLLoader = new URLLoader();
		private var lists:Array;
		
		public function Preloader(p_main:Main)
		{
			main = p_main;
			
			//label = new Label(main, 0, 0, "");
			//listLabel = new Label(main, 0, 0, "");
			
			if (ExternalInterface.available)
			{
				ExternalInterface.addCallback("recieveList", processList);	
				ExternalInterface.call("getList", " ");
			}
		}
		
		public function processList(list:String):void
		{
			//label.changeText(300, 300, 35, list, 1000);
			lists = list.split(/@/);
			for (var i:int = 0; i < lists.length; i++)
			{
				loaderList.push("../FileLists/" + lists[i] + "List.txt");
			}
			loadNextList();
		}
		
		private function loadNextList(e:Event = null):void
		{
			
			//listLabel.changeText(300, 200, 35, "Loading: " + loaderList[listIndex], 1000);
			if (loaderList.length != listIndex)
			{
				myTextLoader.addEventListener(Event.COMPLETE, onLoaded);
				myTextLoader.load(new URLRequest(loaderList[listIndex]));
				listIndex++;
			}
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
			myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, loadNext);
			//label.changeText(300, 300, 35, "Loading: " + url[index] + " " + (int)((index / url.length) * 100) + "%", 1000);
			var fileRequest:URLRequest = new URLRequest(url[index]);
			myLoader.load(fileRequest);
		}
		
		private function loadNext(e:Event = null):void
		{
			index++;
			//label.changeText(300, 300, 35, "Loading: " + url[index] + " " + (int)((index / url.length) * 100) + "%", 1000);
			if (index >= url.length)
			{
				loadNextList();
			}
			else
			{
				var fileRequest:URLRequest = new URLRequest(url[index]);
				myLoader.load(fileRequest);
			}
		
		}
	}

}
package 
{
	import flash.display.Sprite;
	import flash.display.Loader;
	import flash.events.Event;
	import flash.media.Microphone;
	import flash.net.*;
	
	/**
	 * ...
	 * @author Rhett
	 */
	public class GenerateData extends Sprite 
	{
		private var names:Array;
		
		private var first:String;
		private var interest:int;
		private var personality:int;
		private var values:int;
		private var resilience:int;
		private var motivation:int;
		private var projective:int;
		private var index:int;
		
		private var radar:RadarGraph;
		private var main:Main;
		
		public function GenerateData(m:Main, r:RadarGraph)
		{
			radar = r;
			main = m;
			removeEventListener(Event.ADDED_TO_STAGE, init);
			
			names = new Array();
			var maleLoader:URLLoader = new URLLoader();
			maleLoader.addEventListener(Event.COMPLETE, onLoadedM);
			maleLoader.load(new URLRequest("male.txt"));
		}
		
		private function populateData():void
		{
			
			for (var i:int = 0; i < 15; i++)
			{
				//trace("Person: "+i);
				var num:int = Math.random() * names.length;
				first = names[num];
				
				num = Math.random() * 75 + 13;
				interest = num;
				num = Math.random() * 75 + 13;
				values = num;
				num = Math.random() * 75 + 13;
				motivation = num;
				num = Math.random() * 75 + 13;
				personality = num;
				num = Math.random() * 75 + 13;
				resilience = num;
				num = Math.random() * 75 + 13;
				projective = num;
				
				trace(first);
				trace(interest);
				trace(values);
				trace(personality);
				trace(motivation);
				trace(resilience);
				trace(projective);
				trace();
				radar.userData.push(new UserData(main, radar, first, interest, personality, values, resilience, motivation, projective, i));
				//main.userData[main.userData.length - 1].printOut();
			}
		}
		
		private function onLoadedM(e:Event):void 
		{
			var myArrayOfLines:Array = e.target.data.split(/\n/);
			
			for (var i:int = 0; i < myArrayOfLines.length; i++)
			{
				names[i] = myArrayOfLines[i];
			}
			var femaleLoader:URLLoader = new URLLoader();
			femaleLoader.addEventListener(Event.COMPLETE, onLoadedF);
			femaleLoader.load(new URLRequest("female.txt"));
		}
		
		private function onLoadedF(e:Event):void 
		{
			var myArrayOfLines:Array = e.target.data.split(/\n/);
			
			for (var i:int = 0; i < myArrayOfLines.length; i++)
			{
				var num:int = myArrayOfLines[i].indexOf(" ");
				names.push(myArrayOfLines[i]);
			}
			populateData();
		}
		
		
	}
	
}
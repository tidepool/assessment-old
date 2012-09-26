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
		private var departments:Array;		
		private var personalities:Array;
		private var interests:Array;	
		private var motivations:Array;
		private var valuesArray:Array;
		private var personalityCodes:Array;
		private var interestCodes:Array;
		private var positions:Array;
		
		
		private var first:String;
		private var department:String;
		private var position:String;
		private var worktype:String;
		
		private var personality:String;
		private var resilience:Number;
		private var motivation:Array=new Array();
		private var values:Array=new Array();
		private var interest:String;
		private var main:Main;
		
		public function GenerateData(m:Main)
		{
			main = m;
			removeEventListener(Event.ADDED_TO_STAGE, init);
			
			names = new Array();
			departments = new Array("Sales", "Accounting", "Human Resources", "Legal", "Engineering", "Tech Support", "Managment", "Marketing");	
			positions = new Array("Entry", "Lead", "Intern", "Executive");	
			personalities = new Array("High Conscientiousness", "High Agreeableness", "High Extroversion", "High Neuroticism", "High Openness", "Low Conscientiousness", "Low Agreeableness", "Low Extroversion", "Low Neuroticism", "Low Openness");
			personalityCodes = new Array("HC", "HA", "HE", "HN", "HO", "LC", "LA", "LE", "LN", "LO");		
			interestCodes = new Array("A", "C", "E", "I", "R", "S");	
			interests = new Array("Artistic", "Conventional", "Enterprising", "Investigative", "Realistic", "Social");
					
			motivations = new Array("Social Acceptance", "Interdependence", "Leadership", "Energy", "Orderliness", "Peacefullness", "Curiosity", "Altruism");
			 valuesArray= new Array("Money", "Power", "Achievement", "Challenge", "Independence", "Recognition", "Service to Others", "Variety");
			
			var maleLoader:URLLoader = new URLLoader();
			maleLoader.addEventListener(Event.COMPLETE, onLoadedM);
			maleLoader.load(new URLRequest("male.txt"));
		}
		
		private function populateData()
		{
			
			for (var i:int = 0; i < 5000; i++)
			{
				//trace("Person: "+i);
				var num:int = Math.random() * names.length;
				first = names[num];
				
				num = Math.random() * departments.length;
				department = departments[num];	
				
				num = Math.random() * positions.length;
				position = positions[num];	
				
				num = Math.random() * personalityCodes.length;
				var num2:int = Math.random() * interestCodes.length;
				personality = personalities[num];				
				interest = interests[num2];
				worktype = personalityCodes[num]+interestCodes[num2];
				
				num = Math.random() * 70+40;
				resilience = num;
				
				values = new Array();
				for (var j:int = 0; j < 2; j++)
				{
					num = Math.random() * valuesArray.length;
					values.push(valuesArray[num]);
					//trace(num);
				}
				
				motivation = new Array();
				for (j = 0; j < 2; j++)
				{
					num = Math.random() * motivations.length;
					motivation.push(motivations[num]);
				}
				/*
				trace(resilience);
				trace(worktype);
				trace(personality);
				trace(interest);
				trace(first);
				trace(department);
				trace();
				*/
				
			//trace("length: " + motivation.length);
				main.userData.push(new UserData(first, department, position, worktype, personality, resilience, motivation, values, interest));
				main.userData[main.userData.length - 1].printOut();
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
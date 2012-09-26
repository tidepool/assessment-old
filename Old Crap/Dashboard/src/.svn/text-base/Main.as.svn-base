package 
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	/**
	 * ...
	 * @author Wei
	 */
	public class Main extends Sprite 
	{
		public var prefix:String = "";
		public var personality:RadioButtons;
		
		public var resilience:slider;
		
		public var motivation:CheckButtons;
		public var values:CheckButtons;
		
		public var interests:RadioButtons;
		
		public var table:Table;
		public var userData:Array;
		public var tableData:Array = new Array();
		
		public var bg:picture;
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			// entry point
			userData = new Array();
			new GenerateData(this);
			
			bg=new picture(this,800,400,"assets/bg.png",1600);
			
			
			
			new label(this, 165,70 , "Interests", 25, 240, false);
			interests = new RadioButtons(this, 100,120 );
			interests.addButton("Artistic");
			interests.addButton("Conventional");
			interests.addButton("Enterprising");
			interests.addButton("Investigative");
			interests.addButton("Realistic");
			interests.addButton("Social");
			
			new label(this, 155, 275, "Values", 25, 200, false);
			values = new CheckButtons(this,100 , 320);
			values.addButton("Money");
			values.addButton("Power");
			values.addButton("Achievement");
			values.addButton("Challenge");
			values.addButton("Independence");
			values.addButton("Recognition");
			values.addButton("Service to Others");
			values.addButton("Variety");
			
			
			new label(this, 185, 530, "Motivation", 25, 200, false);
			motivation = new CheckButtons(this, 100, 580);
			motivation.addButton("Social Acceptance");
			motivation.addButton("Interdependence");
			motivation.addButton("Leadership");
			motivation.addButton("Energy");
			motivation.addButton("Orderliness");
			motivation.addButton("Peacefulness");
			motivation.addButton("Curiosity");
			motivation.addButton("Altruism");
			
			
			new label(this,500 , 70, "Personality", 25, 200, false);
			personality = new RadioButtons(this, 420, 120);
			personality.addButton("High Conscientiousness");
			personality.addButton("High Agreeableness");
			personality.addButton("High Extroversion");
			personality.addButton("High Neuroticism");
			personality.addButton("High Openness");
			personality.addButton("Low Conscientiousness");
			personality.addButton("Low Agreeableness");
			personality.addButton("Low Extroversion");
			personality.addButton("Low Neuroticism");
			personality.addButton("Low Openness");
			
			
			
			//personality = new CheckButtons(this, 400, 50);
			new label(this, 500, 400, "Resilience", 25, 200, false);
			resilience = new slider(this, 480, 440, 300, "", "");
			
			
			stage.addEventListener(Event.ENTER_FRAME, update);
			stage.addEventListener(MouseEvent.MOUSE_UP, displayData);
			table=new Table(this);
		}
		
		public function update(e:Event):void
		{
			if (contains(bg.sprite))
			{
				setChildIndex(bg.sprite,0);
			}
		}
		
		public function displayData(e:Event=null):void
		{
			tableData = new Array();
			for (var i:int = 0; i < userData.length; i++ )
			{
				if (filter(userData[i]))
				{
					tableData.push(userData[i]);
				}
			}
			table.changeData(tableData);
		}
		
		public function filter(data:UserData):Boolean
		{
			return data.filter(personality.statusString,resilience.percentage,motivation.statusString,values.statusString,interests.statusString);
		}
	}
	
}
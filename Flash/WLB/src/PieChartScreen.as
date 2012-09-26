package  
{
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	
	public class PieChartScreen 
	{
		public var main:Main;
		public var changes:String;
		private var instructions:label;
		private var pie:PieChart;
		public function PieChartScreen(p_main:Main) 
		{
			main = p_main;
		}
		
		public function render():void
		{
			pie=new PieChart(main);
			instructions = new label(main, 900, 200, "What is your preferred percentage of time spent at work versus at home? Adjust the pie chart.");
			instructions.changeWidth(600);
			main.getTime();
		}
		
		public function update():void
		{
			pie.update();
		}
		
		public function keyPress():void
		{
			
		}
		
		public function writeXML():void
		{
			var s1:String = pie.texts[0].text;
			var s2:String = pie.percentage[1];
			main.changesString += "<pie>" + pie.buttons[0].changes + "</pie>";
			main.xmlString += "<pie>"+s2+"</pie>";
		}
		
		public function displayNext():void
		{
			main.displayNext();
		}
	}

}
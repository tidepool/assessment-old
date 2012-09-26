package 
{
	import flash.display.BitmapData;
	import flash.display.DisplayObject;
	import flash.display.Sprite;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Matrix;
	import flash.text.TextField;
	import flash.text.TextFormat;
	
	/**
	 * ...
	 * @author wei
	 */
	public class Main extends Sprite 
	{
		public var test:label;
		public var barC:barChart;
		public var barCCom:barChart;
		public var barCBig:barChart;
		public var donut:donutchart;
		public var clickmask:picture
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			// entry point
			stage.scaleMode = StageScaleMode.NO_SCALE;
			
			barC = new barChart(this, 1);
			
			barCCom = new barChart(this, 2);
			barCBig = new barChart(this, 3);
			
			barCBig.addBar(73, "commitment");
			barCBig.addBar(58, "value");
			barCBig.addBar(47, "personality");
			barCBig.addBar(27,"holland");
			barCBig.addBar(47, "motivation");
			barCBig.addBar(27,"projective");
			barCBig.drawBars();
			
			createDonut();
			
			addEventListener(Event.ENTER_FRAME, update);
			addEventListener(Event.ENTER_FRAME, donut.update);
			addEventListener(Event.ENTER_FRAME, barC.update);
			addEventListener(Event.ENTER_FRAME, barCCom.update);
			addEventListener(Event.ENTER_FRAME, barCBig.update);
			
		//	new RotatedText(this);
			new ExitButton(this, 700, 730, "OK");
			clickmask = new picture(this,500,400,"assets/FeedBack/mask.png",2500);
			test = new label(this, 300, 500, "");
			clickmask.sprite.addEventListener(MouseEvent.CLICK, click);
		}
		
		public function update(e:Event):void
		{
			if (contains(clickmask.sprite))
			{
				setChildIndex(clickmask.sprite,numChildren-1);
			}
		}
		
		public function click(e:Event):void
		{
			for (var i:int = 0; i < donut.areas.length; i++ )
			{
				if (donut.areas[i].isActive)
				{
					contructBarChart(donut.areas[i].aname);
					test.changeText(300, 150, 30, donut.areas[i].aname);
					return;
				}
				for (var j:int = 0; j < donut.areas[i].subAreas.length; j++ )
				{
					if (donut.areas[i].subAreas[j].isActive)
					{
						contructBarChartCompare(donut.areas[i].aname);
						test.changeText(300, 150, 30, donut.areas[i].aname+" - "+donut.areas[i].subAreas[j].aname);
						return;
					}
				}
			}
		}
		
		
		public function contructBarChart(s:String):void
		{
			barC.remove();
			barCCom.remove();
			barCBig.remove();
			if (s == "commitment")
			{
				barCBig.addBar(73, "Money");
				barCBig.addBar(58, "Relationships");
				barCBig.addBar(47, "Goals");
				
			}
			else if (s == "value")
			{
				
				barCBig.addBar(73, "Achievement");
				barCBig.addBar(58, "Challenge");
				barCBig.addBar(47, "Independence");
				barCBig.addBar(73, "Money");
				barCBig.addBar(58, "Power");
				barCBig.addBar(47, "Recognition");
				barCBig.addBar(73, "ServiceToOthers");
				barCBig.addBar(73, "Variety");
			}
			else if (s == "personality")
			{
				
				barCBig.addBar(73, "Conscientiousness");
				barCBig.addBar(58, "Agreeableness");
				barCBig.addBar(47, "Extroversion");
				barCBig.addBar(73, "Neuroticism");
				barCBig.addBar(58, "Openness");
			}
			else if (s == "holland")
			{
				
				barCBig.addBar(73, "Social");
				barCBig.addBar(58, "Realistic");
				barCBig.addBar(47, "Investigative");
				barCBig.addBar(73, "Enterprising");
				barCBig.addBar(58, "Conventional");
				barCBig.addBar(47, "Artistic");
			}
			else if (s == "motivation")
			{
				barCBig.addBar(73, "Money");
				barCBig.addBar(58, "Relationships");
				barCBig.addBar(47, "Goals");
			}
			else if (s == "projective")
			{
				barCBig.addBar(73, "wholeForm");
				barCBig.addBar(58, "detailForm");
				barCBig.addBar(47, "negativeSpace");
				barCBig.addBar(73, "movement");
				barCBig.addBar(58, "color");
				barCBig.addBar(47, "achromatic");
				barCBig.addBar(73, "shading");
				barCBig.addBar(73, "texture");
				barCBig.addBar(47, "pairsReflections");
			}
			barCBig.drawBars();
		}
		
		
		
		public function contructBarChartCompare(s:String):void
		{
			barCBig.remove();
			barC.remove();
			barCCom.remove();
			if (s == "commitment")
			{
				barC.addBar(58, "Money");
				barC.addBar(63, "Relationships");
				barC.addBar(52, "Goals");
				
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				
				barC.setMaxValue(73);
				barCCom.setMaxValue(73);
			}
			else if (s == "value")
			{
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				barCCom.addBar(73, "");
				barCCom.addBar(73, "");
				
				barC.addBar(64, "Achievement");
				barC.addBar(84, "Challenge");
				barC.addBar(35, "Independence");
				barC.addBar(64, "Money");
				barC.addBar(74, "Power");
				barC.addBar(63, "Recognition");
				barC.addBar(57, "ServiceToOthers");
				barC.addBar(74, "Variety");
				
				barC.setMaxValue(84);
				barCCom.setMaxValue(84);
			}
			else if (s == "personality")
			{
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				
				barC.addBar(65, "Conscientiousness");
				barC.addBar(74, "Agreeableness");
				barC.addBar(57, "Extroversion");
				barC.addBar(62, "Neuroticism");
				barC.addBar(47, "Openness");
				
				barC.setMaxValue(74);
				barCCom.setMaxValue(74);
			}
			else if (s == "holland")
			{
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				
				barC.addBar(57, "Social");
				barC.addBar(76, "Realistic");
				barC.addBar(57, "Investigative");
				barC.addBar(47, "Enterprising");
				barC.addBar(68, "Conventional");
				barC.addBar(37, "Artistic");
				
				barC.setMaxValue(76);
				barCCom.setMaxValue(76);
			}
			else if (s == "motivation")
			{
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				
				barC.addBar(68, "Money");
				barC.addBar(63, "Relationships");
				barC.addBar(57, "Goals");
				
				barC.setMaxValue(73);
				barCCom.setMaxValue(73);
			}
			else if (s == "projective")
			{
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				barCCom.addBar(73, "");
				barCCom.addBar(58, "");
				barCCom.addBar(47, "");
				barCCom.addBar(73, "");
				barCCom.addBar(73, "");
				barCCom.addBar(47, "");
				
				barC.addBar(68, "wholeForm");
				barC.addBar(47, "detailForm");
				barC.addBar(63, "negativeSpace");
				barC.addBar(68, "movement");
				barC.addBar(35, "color");
				barC.addBar(56, "achromatic");
				barC.addBar(74, "shading");
				barC.addBar(63, "texture");
				barC.addBar(47, "pairsReflections");
				
				barC.setMaxValue(74);
				barCCom.setMaxValue(74);
			}
			barC.drawBars();
			barCCom.drawBars();
		}
		
		
		public function createDonut():void
		{
			donut = new donutchart(this);
			donut.addArea(0xFF3282, 436,"commitment");
				donut.addSubArea(0xDF3282, 34,"Marketing");
				donut.addSubArea(0xBF3282, 73,"Sales");
				donut.addSubArea(0xFF5282, 63,"Accounting");
				donut.addSubArea(0xFF7282, 34,"Personnel");
				donut.addSubArea(0xFF32A2, 73,"IT");
				donut.addSubArea(0xFF3262, 63,"Purchasing");
			
			donut.addArea(0x62FF85, 366,"value");
				donut.addSubArea(0x62CF85, 34,"Marketing");
				donut.addSubArea(0x62AF85, 73,"Sales");
				donut.addSubArea(0x82FF85, 63,"Accounting");
				donut.addSubArea(0xA2FF85, 34,"Personnel");
				donut.addSubArea(0x62FF65, 73,"IT");
				donut.addSubArea(0x62FFA5, 63,"Purchasing");
				
			donut.addArea(0x7327FF, 268,"personality");
				donut.addSubArea(0x7327FF, 34,"Marketing");
				donut.addSubArea(0x9327FF, 73,"Sales");
				donut.addSubArea(0xB327FF, 63,"Accounting");
				donut.addSubArea(0x7347FF, 34,"Personnel");
				donut.addSubArea(0x7367FF, 73,"IT");
				donut.addSubArea(0x7327AF, 63,"Purchasing");
				
			donut.addArea(0xFF5800, 832,"holland");
				donut.addSubArea(0xFF5800, 34,"Marketing");
				donut.addSubArea(0xFF5820, 73,"Sales");
				donut.addSubArea(0xFF5840, 63,"Accounting");
				donut.addSubArea(0xFF5860, 34,"Personnel");
				donut.addSubArea(0xFF5880, 73,"IT");
				donut.addSubArea(0xFF58A0, 63,"Purchasing");
				
			donut.addArea(0xFFFF27, 472,"motivation");
				donut.addSubArea(0xFFFF27, 34,"Marketing");
				donut.addSubArea(0xDFFF27, 73,"Sales");
				donut.addSubArea(0xBFFF27, 63,"Accounting");
				donut.addSubArea(0x9FFF27, 34,"Personnel");
				donut.addSubArea(0x7FFF27, 73,"IT");
				donut.addSubArea(0x5FFF27, 63,"Purchasing");
				
			donut.addArea(0x628451, 735,"projective");
				donut.addSubArea(0x628471, 34,"Marketing");
				donut.addSubArea(0x828451, 73,"Sales");
				donut.addSubArea(0xA28451, 63,"Accounting");
				donut.addSubArea(0x62A451, 34,"Personnel");
				donut.addSubArea(0x62C451, 73,"IT");
				donut.addSubArea(0x628491, 63,"Purchasing");
				
				
			donut.showArea();
		}
		
	}
	
}
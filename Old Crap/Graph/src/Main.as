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
		public var isDragging:Boolean = false;
		public var isNodeDragging:Boolean = false;
		public var startX:Number;
		public var startY:Number;
		public var startMouseX:Number;
		public var startMouseY:Number;
		
		public var buttons:Array = new Array();
		public var g:Graph;
		public var barC:barChart;
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			// entry point
			g=new Graph(this, 600, 300);
			stage.addEventListener(MouseEvent.MOUSE_DOWN, mouseDown);
			stage.addEventListener(MouseEvent.MOUSE_UP, mouseUp);
			stage.addEventListener(Event.ENTER_FRAME, update);
			buttons.push(new checkButton(this, 100, 100));
			buttons.push(new checkButton(this, 100, 200));
			buttons.push(new checkButton(this, 100, 300));
			buttons[0].maskPic.sprite.addEventListener(MouseEvent.CLICK, click);
			buttons[1].maskPic.sprite.addEventListener(MouseEvent.CLICK, click1);
			buttons[2].maskPic.sprite.addEventListener(MouseEvent.CLICK, click);
			buttons[0].isSelected = true;
			new label(this, 200, 100, "Personality");
			new label(this, 200, 200, "Holland");
			new label(this, 200, 300, "Projective");
			
			
			barC = new barChart(this);
			barC.addBar(34, "Openness");
			barC.addBar(25, "Conscientiousness");
			barC.addBar(74, "Extraversion");
			barC.addBar(64,"Agreeableness");
			barC.addBar(35,"Neuroticism");
			barC.drawBars();
			
		}
		
		public function redrawBar():void
		{
			
			barC.remove();
			barC = new barChart(this);
			barC.addBar(34, "Openess");
			barC.addBar(25, "Agreeableness");
			barC.addBar(74, "Neutrocism");
			barC.addBar(64,"Conscienciousness");
			barC.addBar(35,"Extraveision");
			barC.drawBars();
		}
		
		public function update(e:Event):void
		{
			if (isDragging&&!isNodeDragging)
			{
		//		x = startX+ stage.mouseX - startMouseX;
		//		y = startY + stage.mouseY - startMouseY;
			}
		}
		
		public function mouseDown(e:Event):void
		{
			startX = x;
			startY = y;
				startMouseX = stage.mouseX;
				startMouseY = stage.mouseY;
				isDragging = true;
		}
		
		public function mouseUp(e:Event):void
		{
			isDragging = false;
		}
		
		public function click(e:Event):void
		{
			g.reset1();
		}
		
		public function click1(e:Event):void
		{
			g.reset1();
		}
		
	}
	
}
package
{
	import flash.utils.getTimer;
	import flash.utils.Timer;
	
	public class MacBar
	{
		public var isDragging:Boolean = false;
		public var maxScale:Number = 2;		
		public var unitLength:Number;
		public var changes:int = 0;
		
		private var main:Main;
		private var length:int = 0;		
		private var margin:Number;		
		private var positionX:Number;
		private var positionY:Number;		
		private var defaultPosition:Array = new Array();
		private var scaledPosition:Array = new Array();
		private var mouseDistance:Array = new Array();
		private var scales:Array = new Array();
		private var lengths:Array = new Array();
		private var offset:Array = new Array();
		private var lastMouseX:Number;
		private var lastMouseY:Number;		
		private var units:Array = new Array();
		private var oldUnits:Array;
		private var initialUnits:Array;
		private var elapsedTime:Number;
		private var macBarChanges:String;
		
		public function MacBar(p_main:Main)
		{
			main = p_main;
			positionX = 150;
			positionY = 360;
			unitLength = 150;
			margin = 30;
		}
		
		public function addUnit(s:String):void
		{
			length++;
			defaultPosition.push(0);
			scaledPosition.push(0);
			mouseDistance.push(0);
			scales.push(0);
			lengths.push(0);
			offset.push(0);
			calculateDefaut();
			units.push(new BarUnit(main, this, defaultPosition[length - 1], positionY, s));
		}
		
		public function remove():void
		{
			for (var i:int = 0; i < units.length; i++)
			{				
				units[i].remove();
			}
		}
		
		public function trackChange():void
		{
			var temp:String;
			var time:Number;
			time = getTimer() - elapsedTime;
			macBarChanges += "#";
			for (var i:int = 0; i < units.length; i++)
			{				
				temp = units[i].getString();
				temp = temp.substring(7, temp.length - 4);
				macBarChanges += temp + "-";
			}
			macBarChanges += "@" + time;
			elapsedTime = getTimer();
			trace(macBarChanges);
		}
		
		public function trackSetDown():void
		{
			var temp:String;
			var time:Number;
			time = getTimer() - elapsedTime;
			macBarChanges += "#no@" + time;
			elapsedTime = getTimer();
			trace(macBarChanges);
		}
		
		public function trackClick(str:String):void
		{
			var time:Number;
			time = getTimer() - elapsedTime;
			macBarChanges += "*" + str + "@" + time;
			elapsedTime = getTimer();
			trace(macBarChanges);
		}
		
		public function setIntial():void
		{
			initialUnits = new Array();
			macBarChanges = "";
			for (var i:int = 0; i < units.length; i++)
			{
				initialUnits[i] = units[i].getString();
				macBarChanges += initialUnits[i].substring(7, initialUnits[i].length - 4) + "-";
			}
			macBarChanges = macBarChanges.substring(0, macBarChanges.length - 1);
			elapsedTime = getTimer();
			trace(macBarChanges);
		}
		
		private function calculateDefaut():void
		{
			for (var i:int = 0; i < length; i++)
			{
				defaultPosition[i] = positionX + (unitLength + margin) * i;
			}
		}
		
		public function update():void
		{
			if (isDragging)
			{
				units.sortOn("currX", Array.NUMERIC);
			}
			
			calculateDestinations();
			
			for (var i:int = 0; i < length; i++)
			{
				units[i].destinationX = scaledPosition[i];
				units[i].destinationLength = lengths[i];
				units[i].update();
			}
			
			lastMouseX = main.mouseX;
			lastMouseY = main.mouseY;
		}
		

		public function populateStrings():void
		{
			oldUnits = new Array();
			for (var i:int = 0; i < units.length; i++)
			{
				oldUnits[i] = units[i].getString();
			}
		}
		
		public function compareUnits():Boolean
		{
			for (var i:int = 0; i < units.length; i++)
			{
				if (oldUnits[i] != units[i].getString())
				{
					return false;
				}
				
			}
			return true;
		}
		
		private function calculateDestinations():void
		{
			if (main.mouseY > positionY - 50 && main.mouseY < positionY + 50)
			{
				calculateMouseDistance();
				calctlateScale();
				calculateScaledPosition();
			}
			else
			{
				for (var i:int = 0; i < length; i++)
				{
					scaledPosition[i] = defaultPosition[i];
					lengths[i] = unitLength;
				}
			}
		}
		
		private function calculateMouseDistance():void
		{
			for (var i:int = 0; i < defaultPosition.length; i++)
			{
				mouseDistance[i] = main.mouseX - defaultPosition[i];
				if (mouseDistance[i] < 0)
				{
					mouseDistance[i] = -mouseDistance[i];
				}
			}
		}
		
		private function calctlateScale():void
		{
			for (var i:int = 0; i < defaultPosition.length; i++)
			{
				scales[i] = 1 + (maxScale - 1) / (mouseDistance[i] / 100 + 1);
				lengths[i] = unitLength * scales[i];
			}
		}
		
		private function calculateScaledPosition():void
		{
			var index:int;
			var initLength:Number;
			var originalPosition:Number;
			
			if (main.mouseX < defaultPosition[i])
			{
				index = 0;
				offset[index] = 0;
				originalPosition = defaultPosition[0];
			}
			else if (main.mouseX > defaultPosition[defaultPosition.length - 1])
			{
				index = defaultPosition.length - 1;
				offset[index] = 0;
				originalPosition = defaultPosition[index];
			}
			else
			{
				for (var i:int = 0; i < defaultPosition.length - 1; i++)
				{
					if ((main.mouseX - defaultPosition[i] >= 0) && (main.mouseX - defaultPosition[i + 1] <= 0))
					{
						index = i;
						break;
					}
				}
				initLength = margin + lengths[index] / 2 + lengths[index + 1] / 2;
				offset[index] = -initLength / (unitLength + margin) * mouseDistance[index];
				offset[index + 1] = initLength / (unitLength + margin) * mouseDistance[index + 1];
				originalPosition = main.mouseX;
			}
			for (i = index - 1; i >= 0; i--)
			{
				offset[i] = offset[i + 1] - lengths[i + 1] / 2 - margin - lengths[i] / 2;
			}
			for (i = index + 1; i < lengths.length; i++)
			{
				offset[i] = offset[i - 1] + lengths[i - 1] / 2 + margin + lengths[i] / 2;
			}
			for (i = 0; i < lengths.length; i++)
			{
				scaledPosition[i] = originalPosition + offset[i];
			}
		}
		
		public function getXML():String
		{
			var xmlString:String = "<bar" + main.stageIndex + ">";
			xmlString += "<changes>" + macBarChanges + "</changes>";
			for (var i:int = 0; i < units.length; i++)
			{
				var temp:String = units[i].getString();
				xmlString += "<pref>" + temp + "</pref>";
			}
			xmlString += "</bar" + main.stageIndex + ">";
			return xmlString;
		}
	
	}

}
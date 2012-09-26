package  
{
	/**
	 * ...
	 * @author Wei
	 */
	public class UserData 
	{
		public var name:String;
		public var department:String;
		public var position:String;
		public var worktype:String;
		
		public var personality:String;//radio
		public var resilience:Number;
		public var motivation:Array;
		public var values:Array;
		public var interest:String;//radio
		
		public function UserData(n:String, d:String, p:String, w:String, per:String, r:Number, m:Array, v:Array, i:String) 
		{
			name = n;
			department = d;
			position = p;
			worktype = w;
			personality = per;
			resilience = r;
			motivation = m;
			values = v;
			interest = i;
		}
		
		public function filter(p_personality:String, p_resilience:Number, p_motivation:Array, p_values:Array, p_interests:String):Boolean
		{
			if (personality == p_personality)
			{
				if (resilience > p_resilience-30 && resilience < p_resilience + 30)
				{
					trace(resilience);
					trace(p_resilience);
					if (contains(motivation, p_motivation))
					{
						if (contains(values, p_values))
						{
							if (interest == p_interests)
							{
								return true;
							}
						}
					}
				}
			}
			return false;
		}
		
		
		public function contains(a:Array,b:Array):Boolean
		{
			for (var i:int = 0; i < a.length; i++ )
			{
				for (var j:int = 0; j < b.length; j++ )
				{
					if (a[i] == b[j])
					{
						return true;
					}
				}
				
			}
			return false;
		}
		
		public function printOut():void
		{
			var motString:String = "";
			for (var i:int = 0; i < motivation.length; i++)
			{
				motString += "\t" + motivation[i];
			}
			
			var valString:String = "";
			for (var i:int = 0; i < values.length; i++)
			{
				valString += "\t" + values[i];
			}
			trace(name + "\t" + department + "\t" + position + "\t" + worktype + "\t" + personality + "\t" + interest + "\t" + resilience + motString + valString);
			
		}
	}

}
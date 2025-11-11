interface Vehicle {
  id: number;
  image: string;
  make: string;
  model: string;
  version: string;
  price: number;
  salePoint: string;
}

interface Schedule {
  id: number;
  vechileId: number;
  scheduledAt: string;
}

interface Schedules {
  [date: string]: Schedule[];
}

export type { Vehicle, Schedule, Schedules };

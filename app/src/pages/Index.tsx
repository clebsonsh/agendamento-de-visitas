import { Box } from "@mui/material";
import { useQuery } from "@tanstack/react-query";
import { Link } from "react-router";

import VehicleCard from "../components/VehicleCard";

import type { Vehicle } from "../types/entities";

function Index() {
  const url = import.meta.env.VITE_BACKEND_URL + "api/v1/vehicles";

  const query = useQuery({
    queryKey: ["vehicles"],
    queryFn: () => fetch(url).then((res) => res.json()),
  });

  return (
    <Box sx={{ display: "flex", justifyContent: "space-between", gap: 4 }}>
      {query.data?.vehicles?.map((vehicle: Vehicle) => (
        <Link to={`/${vehicle.id}`} style={{ textDecoration: "none" }}>
          <VehicleCard key={vehicle.id} {...vehicle} />
        </Link>
      ))}
    </Box>
  );
}

export default Index;

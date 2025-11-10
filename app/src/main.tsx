import { createRoot } from "react-dom/client";
import CssBaseline from "@mui/material/CssBaseline";
import { StrictMode } from "react";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route } from "react-router";

import Layout from "./components/Layout.tsx";
import Index from "./pages/Index.tsx";
import Schedule from "./pages/Schedule.tsx";

const queryClient = new QueryClient();
createRoot(document.getElementById("root")!).render(
  <StrictMode>
    <CssBaseline />
    <QueryClientProvider client={queryClient}>
      <BrowserRouter>
        <Layout>
          <Routes>
            <Route path="/" element={<Index />} />
            <Route path=":vehicleId" element={<Schedule />} />
          </Routes>
        </Layout>
      </BrowserRouter>
    </QueryClientProvider>
  </StrictMode>,
);

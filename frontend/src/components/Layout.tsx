import Container from "@mui/material/Container";
import React from "react";

import MenuAppBar from "./MenuAppBar";

interface LayoutProps {
  children: React.ReactNode;
}

function Layout({ children }: LayoutProps) {
  return (
    <>
      <MenuAppBar />
      <Container maxWidth="xl" sx={{ marginTop: 8 }}>
        {children}
      </Container>
    </>
  );
}

export default Layout;

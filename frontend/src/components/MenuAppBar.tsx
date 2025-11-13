import AppBar from "@mui/material/AppBar";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import Toolbar from "@mui/material/Toolbar";
import Typography from "@mui/material/Typography";
import { Link } from "react-router";

export default function MenuAppBar() {
  return (
    <Box sx={{ flexGrow: 1 }}>
      <AppBar position="static" color="transparent">
        <Container maxWidth="xl">
          <Toolbar disableGutters={true}>
            <Box
              sx={{
                display: "flex",
                justifyContent: "space-between",
                width: "100%",
              }}
            >
              <Box>
                <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
                  <Link to="/" style={{ textDecoration: "none" }}>
                    Loop
                  </Link>
                </Typography>
              </Box>
              <Box
                sx={{
                  display: "flex",
                  justifyItems: "center",
                  gap: "42px",
                }}
              >
                <Typography variant="h6" component="div">
                  Vender
                </Typography>
                <Typography variant="h6" component="div">
                  Comprar
                </Typography>
                <Typography variant="h6" component="div">
                  Lojas
                </Typography>
              </Box>
            </Box>
          </Toolbar>
        </Container>
      </AppBar>
    </Box>
  );
}

interface ScheduleDayButtonProps {
  day: string;
  active: boolean;
  handleClick: (day: string) => void;
}
function ScheduleDayButton({
  day,
  active,
  handleClick,
}: ScheduleDayButtonProps) {
  const date = new Date(day + " 00:00:00");

  const dayName: string = date
    .toLocaleDateString("pt-BR", {
      weekday: "long",
    })
    .toUpperCase()
    .slice(0, 3);

  const dayNumber: number = date.getDate();

  return (
    <button
      style={{
        backgroundColor: active ? "#4c9300" : "#f0f0f0",
        borderColor: "transparent",
        color: active ? "#f0f6fc" : "inherit",
        cursor: active ? "inherit" : "pointer",
        padding: "20px 24px",
        borderRadius: "50%",
        display: "flex",
        flexDirection: "column",
        boxShadow: "var(--Paper-shadow)",
      }}
      onClick={() => handleClick(day)}
    >
      <div>{dayName}</div>
      <div>{dayNumber}</div>
    </button>
  );
}

export default ScheduleDayButton;

interface ScheduleDayButtonProps {
  day: string;
  selected: boolean;
  handleClick: (day: string) => void;
}

function ScheduleDayButton({
  day,
  selected,
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
        backgroundColor: selected ? "#4c9300" : "#f0f0f0",
        borderColor: "transparent",
        color: selected ? "#f0f6fc" : "inherit",
        cursor: selected ? "inherit" : "pointer",
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

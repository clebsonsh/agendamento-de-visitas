import type { Schedule } from "../../types/interfaces";

interface ScheduleHourButtonProps {
  schedule: Schedule;
  disabled: boolean;
  selected: boolean;
  handleClick: (schedle: Schedule) => void;
}

const scheduleHourButtonStyles = {
  default: {
    backgroundColor: "#f0f0f0",
    borderColor: "transparent",
    cursor: "pointer",
    padding: "12px 30px",
    borderRadius: "30px",
    boxShadow: "var(--Paper-shadow)",
  },
  active: {
    backgroundColor: "#4c9300",
    borderColor: "transparent",
    color: "#f0f6fc",
    padding: "12px 30px",
    borderRadius: "30px",
    boxShadow: "var(--Paper-shadow)",
  },
  disabled: {
    backgroundColor: "#f0f0f0",
    borderColor: "transparent",
    padding: "12px 30px",
    borderRadius: "30px",
  },
};

function ScheduleHourButton({
  schedule,
  disabled,
  selected,
  handleClick,
}: ScheduleHourButtonProps) {
  const hour = new Date(schedule.scheduledAt).getHours() + ":00";

  const activeStyle = disabled ? "disabled" : selected ? "active" : "default";

  const style = scheduleHourButtonStyles[activeStyle];

  return (
    <button
      disabled={disabled}
      style={style}
      onClick={() => handleClick(schedule)}
    >
      {hour}
    </button>
  );
}

export default ScheduleHourButton;

import type { Schedule } from "../types/entities";

interface ScheduleHourButtonProps {
  schedule: Schedule;
  disabled: boolean;
  active: boolean;
  handleClick: (id: number) => void;
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
  active,
  handleClick,
}: ScheduleHourButtonProps) {
  const getHourAndMinutes = (scheduledAt: string) => {
    const hour = new Date(scheduledAt).getHours();

    return `${hour}:00`;
  };

  const activeStyle = disabled ? "disabled" : active ? "active" : "default";

  const style = scheduleHourButtonStyles[activeStyle];

  return (
    <button
      disabled={disabled}
      style={style}
      onClick={() => handleClick(schedule.id)}
    >
      {getHourAndMinutes(schedule.scheduledAt)}
    </button>
  );
}

export default ScheduleHourButton;
